package pieces;

import chessboard.Chessboard;

public class Bishop extends Piece
{
	public Bishop(Color color, Chessboard b, int row, int col)
	{
		super(color, Icon.B, b, row, col, 3);
	}
	
	@Override
	public void move(int row, int col)
	{
		if (canMove(row, col))
				super.move(row, col);
	}
	
	@Override
	public boolean canCapture(int row, int col)
	{
		if (!super.canCapture(row, col))
			return false;
		if (Math.abs(row - getRow()) != Math.abs(col - getCol()))
		        return false;
		if (hasPieceBetween(row, col))
			return false;
		return true;
	}

	@Override
	public boolean canMove(int row, int col)
	{
		if (!super.canMove(row, col))
			return false;
		if (board.getPieceAt(row, col) != null)
			return false;
		if (Math.abs(row - getRow()) != Math.abs(col - getCol()))
			return false;
		if (hasPieceBetween(row, col))
			return false;
		return true;
	}
	
	@Override
	public void capture(Piece pieceToCapture)
	{
		int enemyRow = pieceToCapture.getRow();
		int enemyCol = pieceToCapture.getCol();
		if (canCapture(enemyRow, enemyCol))
				super.capture(pieceToCapture);
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
}