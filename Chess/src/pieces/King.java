package pieces;

import java.util.ArrayList;
import java.util.LinkedList;

import pieces.piece.Piece;
import player.Player;

import chessboard.Chessboard;
import chessboard.Utils;

// TODO Refactor King.java
public class King extends Piece
{
	private LinkedList<Piece> piecesAttacking = new LinkedList<Piece>();
	public boolean[][] mapWithoutEnemies = new boolean[3][3];

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
//		check if destination is in range
		if (!Utils.inRange(row, col))
			return false;
//		check color
		if (!super.canCapture(row, col))
			return false;
//		check if destination is valid for king 
		if (Math.abs(row - getRow()) > 1 ||
				Math.abs(col - getCol()) > 1)
			return false;
//		return true if there's no friend piece in its way
		return true;
	}

	public boolean canMove(int row, int col)
	{
		if (!super.canMove(row, col))
			return false;
//		check if destination is in range
		if (!Utils.inRange(row, col))
			return false;
//		check if can castle
		if (can_castle(row, col))
			return true;
//		check if there's a pice on destination
		if (board.getPieceAt(row, col) != null)
			return false;
//		check if destination is valid for king 
		if (Math.abs(row - getRow()) > 1 || 
				Math.abs(col - getCol()) > 1)
			return false;
		return true;
	}
	

//	Consider a matrix 3x3 of possible moves, where king is at a(1,1)
//	and a(i,j) is false if it's being attacked	
	public boolean is_checkmated(Player friend, Player enemy)
	{
		ArrayList <Piece> enemyPieces = enemy.getPiecesAlive();
		ArrayList<Piece> friendPieces = friend.getPiecesAlive();
		if (!is_checked(enemy.getPiecesAlive()))
			return false;
		if (can_move_safely(enemyPieces))
			return false;
		if (can_be_defended(friendPieces))
			return false;
		return true;
	}
	
	public boolean is_checked(ArrayList<Piece> enemyPieces)
	{
//		empty list of pieces attacking
		piecesAttacking.clear();
//		for each enemy piece
		for (Piece piece : enemyPieces) {
//			check if king current position is a possible capture position
			if (piece.canCapture(getRow(), getCol()) &&
					!piece.isCaptured()) {
				piecesAttacking.add(piece);
			}
		}
//		if there's at least one piece attacking return true
		if (piecesAttacking.size() > 0)
			return true;
		return false;
	}

	public boolean is_checked()
	{
//		get enemy pieces based on color
		LinkedList <Piece> enemyPieces = new LinkedList <Piece>();
		Color enemyColor;
		if (hasSameColor(Color.BLACK))
			enemyColor = Color.BLACK;
		else
			enemyColor = Color.WHITE;
		for (int i = 0; i < 8; i++) {
			for (int j = 0; j < 8; j++) {
				if (board.getPieceAt(i, j) != null) {
					Piece p = board.getPieceAt(i, j);  
					if (!p.hasSameColor(enemyColor) &&
							!p.isCaptured())
						enemyPieces.add(p);
				}
			}
		}
//		empty list of pieces attacking
		piecesAttacking.clear();
//		for each enemy piece
		for (Piece piece : enemyPieces) {
//			check if king current position is "capturable"
			if (piece.canCapture(getRow(), getCol())) {
				piecesAttacking.add(piece);
			}
		}
//		if there's at least one piece attacking return true
		if (piecesAttacking.size() > 0)
			return true;
		return false;
	}

	public boolean would_be_checked(ArrayList<Piece> enemies,
			int destRow,
			int destCol)
	{
		boolean checked = false;
//		backup current king position
		int currentRow = getRow();
		int currentCol = getCol();
//		remove king from board, so it doesn't disturb
		board.removePiece(currentRow, currentCol);
		setRow(Integer.MIN_VALUE);
		setCol(Integer.MIN_VALUE);
		setCaptured(true);
//		if there's an enemy piece on cell being checked
//              remove simulating a capture by King
		Piece tmpEnemy = board.getPieceAt(destRow, destCol);
		if (tmpEnemy != null && tmpEnemy.getColor() != getColor()) {
//			remove it from board, temporarily
			board.removePiece(destRow, destCol);
			tmpEnemy.setRow(Integer.MIN_VALUE);
			tmpEnemy.setCol(Integer.MIN_VALUE);
			tmpEnemy.setCaptured(true);
		}
//		for each enemy piece
		for (Piece p : enemies) {
//			verify if it could capture king
			if (p.canCapture(destRow, destCol)) {
			        checked = true;
			        break;
			}
		}
//		add piece removed back
		if (tmpEnemy != null && tmpEnemy.getColor() != getColor()) {
			board.addPiece(tmpEnemy, destRow, destCol);
			tmpEnemy.setRow(destRow);
			tmpEnemy.setCol(destCol);
			tmpEnemy.setCaptured(false);
		}
		// add king back
		board.addPiece(this, currentRow, currentCol);
		setRow(currentRow);
		setCol(currentCol);
		setCaptured(false);
		// return if it would be checked or not
		return checked;
	}

	private boolean can_be_defended(ArrayList<Piece> friendPieces)
	{
//		Conditions to be defended
//		1. It's being attacked by a single piece
//		2. Some friend piece can capture the attacking piece, or 
//		the attacking piece isn't a knight and some friend piece can
//		close its way to the king
//		check condition 1
		if (piecesAttacking.size() > 1)
			return false;
//		remove itself from friendPieces
		friendPieces.remove(this);
//		check if some friend piece can capture the attacking piece
		Piece attackingPiece = piecesAttacking.get(0);
		int row = attackingPiece.getRow();
		int col = attackingPiece.getCol();
		for (Piece friend : friendPieces)
			if (friend.canCapture(row, col))
				return true;
//		check if attacking piece is a knight
		if (attackingPiece.getPieceInitial() == Icon.N)
			return false;
//		check if can close its way to the king
		boolean[][] route = attackingPiece.get_capture_route(this);
		for (int i = 0; i < Utils.BOARD_LENGTH; i++) {
			for (int j = 0; j < Utils.BOARD_LENGTH; j++) {
				if (route[i][j]) {
					for (Piece friend : friendPieces) {
						boolean p = friend.canMove(i,
								j);
						int fRow = friend.getRow();
						int fCol = friend.getCol();
						boolean isChecked = false;
						if (p) {
							super.move(i, j);
							isChecked = is_checked();
							super.move(fRow, fCol);
						}
						if (isChecked)
							return true;
					}
				}
			}
		}
		System.out.println("can't be defended");
		return false;
	}

	private boolean can_move_safely(ArrayList<Piece> enemyPieces)
	{
//		For moving to a safe cell the following conditions must be true
//		1. The cell is not being attacked by an enemy piece
//		2. The cell doesn't have a friend piece
//		3. The cell must be a valid move to king
//		check conditions 2 and 3 for each cell
                int row = getRow();
                int col = getCol();
		for (int i = 0; i < Utils.BOARD_LENGTH; i++) {
			for (int j = 0; j < Utils.BOARD_LENGTH; j++) {
				if (canMove(i, j) || canCapture(i, j)) {
//					check condition 1
					if (!would_be_checked(enemyPieces, i, j)
						&& (row != i || col != j))
						return true;
				}
			}
		}
		System.out.println("can't move safely");
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

	private boolean can_castle(int row, int col)
	{
//		check if destination is proper for castle
		if (Math.abs(getCol() - col) != 2 || 
				Math.abs(getRow() - row) != 0)
			return false;
//		check if it's its first move
		if (getMoves() > 0)
			return false;
//		check if king is checked
		if(is_checked())
			return false;
//		check direction to castle
		int direction = col < getCol() ? -1 : 1;
//		check if there's a rook
		Rook rook;
		if (direction == 1) {
			if (board.getPieceAt(row, 7) == null)
				return false;
			try {
				rook = (Rook) board.getPieceAt(row, 7);
			} catch (ClassCastException e) {
				return false;
			}
//		left
		} else {
			if (board.getPieceAt(row, 0) == null)
				return false;
			try {
				rook = (Rook) board.getPieceAt(row, 0);
			} catch (ClassCastException e) {
				return false;
			}
		}
//		check if that's a friend piece and a rook
		if (rook.getColor() != getColor() || 
				rook.getPieceInitial() != Icon.R)
			return false;
//		check if it's rook first move
		if (rook.getMoves() > 0)
			return false;
//		for each cell between rook and king
		int i = getCol() + direction;
		for (; i != rook.getCol(); i+=direction) {
//			check if there's no piece between king and rook
			if (board.getPieceAt(getRow(), i) != null)
				return false;
		}
		return true;
	}

	public void print_map(boolean[][] map)
	{
		for (int i = 0; i < 3; i++) {
			for (int j = 0; j < 3; j++) {
				System.out.print(map[i][j] + " ");
			}
			System.out.println();
		}
	}
}
