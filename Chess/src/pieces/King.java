package pieces;

import java.util.ArrayList;

import pieces.piece.Piece;
import player.Player;

import chessboard.Chessboard;
import chessboard.Utils;

// TODO Refactor King.java
public class King extends Piece
{
	public King(Color color, Chessboard b, int row, int col)
	{
		super(color, Icon.K, b, row, col);
	}

	@Override
	public void capture(Piece pieceToCapture)
	{
		int enemyRow = pieceToCapture.getRow();
		int enemyCol = pieceToCapture.getCol();
		if (canCapture(enemyRow, enemyCol)) {
			super.capture(pieceToCapture);
		}
	}

	@Override
	public void move(int row, int col)
	{
		if (canMove(row, col))
			super.move(row, col);
		else
			castle(row, col);
	}

	@Override
	public boolean canCapture(int row, int col)
	{
		if (!Utils.inRange(row, col))
			return false;
		if (!super.canCapture(row, col))
			return false;
		if (Math.abs(row - getRow()) > 1 ||
				Math.abs(col - getCol()) > 1)
			return false;
		return true;
	}

	public boolean canMove(int row, int col)
	{
		if (!super.canMove(row, col))
			return false;
		if (!Utils.inRange(row, col))
			return false;
		if (can_castle(row, col))
			return true;
		if (board.getPieceAt(row, col) != null)
			return false;
		if (Math.abs(row - getRow()) > 1 ||
				Math.abs(col - getCol()) > 1)
			return false;
		return true;
	}

	public boolean is_checkmated(Player friend, Player enemy)
	{
		ArrayList <Piece> enemyPieces = enemy.getPiecesAlive();
		ArrayList<Piece> friendPieces = friend.getPiecesAlive();
		if (!is_checked(enemy.getPiecesAlive()))
			return false;
		if (canMoveWithoutBeingChecked(enemyPieces))
			return false;
		if (canBeDefendedByFriends(friendPieces))
			return false;
		return true;
	}

	public boolean is_checked(ArrayList<Piece> enemyPieces)
	{
	        int kingRow = getRow();
	        int kingCol = getCol();
		for (Piece piece : enemyPieces)
			if (piece.canCapture(kingRow, kingCol))
			        return true;
		return false;
	}

	public boolean is_checked()
	{
		int kingRow = getRow();
		int kingCol = getCol();
		for (Piece enemy : getEnemyPiecesFromBoard())
			if (enemy.canCapture(kingRow, kingCol))
				return true;
		return false;
	}

	public boolean would_be_checked(ArrayList<Piece> enemies,
			int destRow,
			int destCol)
	{
		boolean checked = false;
		int kingCurrentRow = getRow();
		int kingCurrentCol = getCol();
		captureTmp(this);
		Piece pieceOnDestination = board.getPieceAt(destRow, destCol);
		if (pieceOnDestination != null &&
			pieceOnDestination.getColor() != getColor())
		        captureTmp(pieceOnDestination);
		for (Piece enemy : enemies) {
			if (enemy.canCapture(destRow, destCol)) {
			        checked = true;
			        break;
			}
		}
		uncaptureTmp(this, kingCurrentRow, kingCurrentCol);
		if (pieceOnDestination != null &&
			pieceOnDestination.getColor() != getColor())
		        uncaptureTmp(pieceOnDestination, destRow, destCol);
		return checked;
	}

	private void captureTmp(Piece piece)
	{
		board.removePiece(piece.getRow(), piece.getCol());
		piece.setRow(Integer.MIN_VALUE);
		piece.setCol(Integer.MIN_VALUE);
		piece.setCaptured(true);
	}

	private void uncaptureTmp(Piece piece, int previousRow, int previousCol)
	{
		board.addPiece(piece, previousRow, previousCol);
		piece.setRow(previousRow);
		piece.setCol(previousCol);
		piece.setCaptured(false);
	}

	/*
	* Requisites to be defended
	* 1. It's being attacked only by a single piece
	* 2. Some friend piece can capture the attacking piece, or
	* the attacking piece isn't a knight and some friend piece can
	* close its route to the king
	*/
	private boolean canBeDefendedByFriends(ArrayList<Piece> friendPieces)
	{
		ArrayList<Piece> piecesAttacking = getAttackingPieces();
		if (piecesAttacking.size() > 1)
			return false;
		Piece enemyPiece = piecesAttacking.get(0);
		int enemyRow = enemyPiece.getRow();
		int enemyCol = enemyPiece.getCol();
		friendPieces.remove(this);
		for (Piece friend : friendPieces)
			if (friend.canCapture(enemyRow, enemyCol))
				return true;
		if (enemyPiece.getPieceInitial() == Icon.N)
			return false;
		return friendsCanCloseRoute(friendPieces, enemyPiece);
	}

	private boolean friendsCanCloseRoute(ArrayList<Piece> friendPieces,
					     Piece enemyPiece)
	{
		boolean[][] route = enemyPiece.getAttackingRoute(enemyPiece);
		for (int i = 0; i < Utils.BOARD_LENGTH; i++) {
			for (int j = 0; j < Utils.BOARD_LENGTH; j++) {
				if (route[i][j]) {
					for (Piece friendPiece : friendPieces) {
						if (friendPiece.canMove(i, j))
							return true;
					}
				}
			}
		}
		return false;
	}

	/**
	 * Requisites for moving safely to a cell:
         * 1. The cell is not being attacked by an enemy piece
         * 2. The cell doesn't have a friend piece
	 * 3. The cell must be a valid move to king
	 */
	private boolean canMoveWithoutBeingChecked(ArrayList<Piece> enemyPieces)
	{
		for (int i = 0; i < Utils.BOARD_LENGTH; i++) {
			for (int j = 0; j < Utils.BOARD_LENGTH; j++) {
			        boolean p = canMove(i, j) || canCapture(i, j);
			        boolean q = !would_be_checked(enemyPieces, i, j);
				if (p && q)
					return true;
			}
		}
		return false;
	}

	public void castle(int row, int col)
	{
		if (can_castle(row, col)) {
//			finally, move king
			super.move(row, col);
//			move rook
			Rook rook = (Rook) board.getPieceAt(row, 0);
			int direction = col < getCol() ? -1 : 1;
			rook.castle(getRow(), getCol() - direction);
		}
	}

	/**
	 * Requisites for castle
	 * - King cannot be checked
	 * - King may not have been moved yet
	 * - There must be a Rook for castling
	 */
	private boolean can_castle(int row, int col)
	{
		Piece rook = board.getPieceAt(row, col);
		if (Math.abs(getCol() - col) != 2 ||
			Math.abs(getRow() - row) != 0)
			return false;
		if (getMoves() > 0)
			return false;
		if (is_checked())
			return false;
		if (rook == null)
			return false;
		if (!rook.hasSameColor(getColor()))
			return false;
		if (rook.getPieceInitial() != Icon.R)
			return false;
		if (rook.getMoves() > 0)
			return false;
                return !hasPieceBetween(rook.getRow(), rook.getCol());
	}

	private boolean hasPieceBetween(int finalRow, int finalCol)
	{
		int startRow = getRow();
		int startCol = getCol();
		int rowDirection = 0;
		int colDirection = 0;
		if (finalRow > startRow)
			rowDirection = -1;
		else if (finalRow < startRow)
			rowDirection = 1;
		if (finalCol > startCol)
			colDirection = -1;
		else if (finalCol < startCol)
			colDirection = 1;
		finalRow += rowDirection;
		finalCol += colDirection;
		while (finalRow != startRow && finalCol != startCol) {
			if (board.getPieceAt(finalRow, finalCol) != null) {
				return true;
			}
			finalRow += rowDirection;
			finalCol += colDirection;
		}
		return false;
	}

	public ArrayList<Piece> getEnemyPiecesFromBoard()
	{
		ArrayList<Piece> enemyPieces = new ArrayList<>();
		for (int i = 0; i < Utils.BOARD_LENGTH; i++) {
			for (int j = 0; j < Utils.BOARD_LENGTH; j++) {
				if (board.getPieceAt(i, j) != null) {
					Piece enemy = board.getPieceAt(i, j);
					if (!hasSameColor(enemy))
						enemyPieces.add(enemy);
				}
			}
		}
		return enemyPieces;
	}

	public ArrayList<Piece> getAttackingPieces()
	{
		ArrayList<Piece> attackingPieces = new ArrayList<>();
		ArrayList<Piece> enemyPieces = getEnemyPiecesFromBoard();
		int kingRow = getRow();
		int kingCol = getCol();
		for (Piece enemy : enemyPieces)
			if (enemy.canCapture(kingRow, kingCol))
			        attackingPieces.add(enemy);
		return attackingPieces;
	}
}
