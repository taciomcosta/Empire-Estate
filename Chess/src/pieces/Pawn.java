package pieces;

import pieces.piece.Piece;
import chessboard.Chessboard;
import chessboard.Utils;

public final class Pawn extends Piece
{
	public Pawn(Color color, Chessboard b, int row, int col)
	{
		super(color, Icon.P, b, row, col, 1);
	}

	@Override
	public void move(int row, int col)
	{
		if (canMove(row, col))
			super.move(row, col);
	}
	
	@Override
	public boolean canMove(int row, int col)
	{
		if (!super.canMove(row, col))
			return false;
		if (!Utils.inRange(row, col))
			return false;
		if (board.getPieceAt(row, col) != null)
			return false;
		if (col != getCol())
			return false;
		if (!canMoveOneSpace(row) && !canMoveTwoSpaces(row, col))
			return false;
		return true;
	}

	private boolean canMoveTwoSpaces(int row, int col)
	{
		return getMoves() == 0 &&
		Math.abs(row - getRow()) == 2 &&
		board.getPieceAt((row + getRow()) / 2, col) == null;
	}

	private boolean canMoveOneSpace(int row)
	{
		if (getColor() == Color.BLACK && row - getRow() != 1)
			return false;
		if (getColor() == Color.WHITE && row - getRow() != -1)
			return false;
		return true;
	}

	@Override
	public void capture(Piece pieceToCapture)
	{
		int enemyRow = pieceToCapture.getRow();
		int firstRow = pieceToCapture.getFirstRow();
		int enemyCol = pieceToCapture.getCol();
		if (canCaptureByDiagonal(enemyRow, enemyCol)) {
			super.capture(pieceToCapture);
		}
		if (canCaptureEnPassant(enemyRow, enemyCol)) {
			super.capture(pieceToCapture);
			int rowToMove = (firstRow + enemyRow) / 2;
			int colToMove = enemyCol;
			super.move(rowToMove, colToMove);
		}
	}
	
	@Override
	public boolean canCapture(int row, int col)
	{
		if (!Utils.inRange(row, col))
			return false;
		if (!super.canCapture(row, col))
			return false;
		if (!canCaptureByDiagonal(row, col) &&
			!canCaptureEnPassant(row, col))
			return false;
		return true;
	}
	
	private boolean canCaptureByDiagonal(int row, int col)
	{
		if (Math.abs(row - getRow()) != 1)
			return false;
		if (Math.abs(col - getCol()) != 1)
                        return false;
		if ((hasSameColor(Color.BLACK) && getRow() >= row))
			return false;
		if ((hasSameColor(Color.WHITE) && getRow() <= row))
			return false;
		return true;
	}


	/**
	 * Different from others canCapture() methods, canCaptureEnPassant()
	 * returns false if cell (enemyRow, enemyCol) is an empty one.
	 */
	private boolean canCaptureEnPassant(int enemyRow, int enemyCol)
	{
		if (board.getPieceAt(enemyRow, enemyCol) == null)
			return false;
		Piece pieceToCapture = board.getPieceAt(enemyRow, enemyCol);
		if (pieceToCapture.getPieceInitial() != Icon.P)
			return false;
		if (pieceToCapture.getMoves() != 1)
			return false;
		if (Math.abs(getCol() - enemyCol) != 1)
			return false;
		if (Math.abs(getRow() - enemyRow) != 0)
			return false;
		return true;
	}

	public boolean canBePromoted()
	{
		if (hasSameColor(Color.WHITE) && getRow() == 0)
			return true;
		if (hasSameColor(Color.BLACK) && getRow() == 7)
			return true;
		return false;
	}
	
	public void promote(Piece pieceToBePromotedTo)
	{
		setCaptured(true);
		pieceToBePromotedTo.setCaptured(false);
		board.removePiece(getRow(), getCol());
		board.addPiece(pieceToBePromotedTo, getRow(), getCol());
		pieceToBePromotedTo.setRow(getRow());
		pieceToBePromotedTo.setCol(getCol());
		unsetPositionFromBoardRange();
	}
}
