package pieces;

import pieces.piece.Piece;
import chessboard.Chessboard;
import chessboard.Utils;

public class Queen extends Piece
{
	public Queen(Color color, Chessboard b, int row, int col)
	{
		super(color, Icon.Q, b, row, col, 9);
	}

	@Override
	public void capture(Piece pieceToCapture)
	{
		int enemyRow = pieceToCapture.getRow();
		int enemyCol = pieceToCapture.getCol();
		if (canCapture(enemyRow, enemyCol))
			super.capture(pieceToCapture);
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
		boolean p = getRow() == row || getCol() == col;
		boolean q = Math.abs(getCol() - col) == Math.abs(row - getRow());
		boolean r = !hasPieceBetween(row, col);
		if ((p || q) && r)
		        return true;
		return false;
	}

	@Override
	public boolean canCapture(int row, int col)
	{
		if (!Utils.inRange(row, col))
			return false;
		if (!super.canCapture(row, col))
			return false;
		if (!canCaptureStraightly(row, col) &&
			!canCaptureDiagonally(row, col))
			return false;
		if (hasPieceBetween(row, col))
			return false;
		return true;
	}

	public boolean canCaptureStraightly(int row, int col)
	{
		return getRow() == row || getCol() == col;
	}

	public boolean canCaptureDiagonally(int row, int col)
	{
		return Math.abs(getCol() - col) == Math.abs(row - getRow());
	}

	@Override
	public void move(int row, int col)
	{
		if (!canMove(row, col))
			return;
		super.move(row, col);
	}

	/*
	* Check if there's a piece in [startPos; finalPos[
	*/
	private boolean hasPieceBetween(int finalRow, int finalCol)
	{
//	        determine direction
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
}