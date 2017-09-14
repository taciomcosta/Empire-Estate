package pieces;

import pieces.piece.Piece;
import chessboard.Chessboard;
import chessboard.Utils;

public class Bishop extends Piece
{
	public Bishop(Color color, Chessboard b, int row, int col)
	{
		super(color, Icon.B, b, row, col);
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
//		check if destination is in range
		if (!Utils.inRange(row, col))
			return false;
//		check color
		if (!super.canCapture(row, col))
			return false;
//		check if it's a diagonal move
		if (Math.abs(row - getRow()) == Math.abs(col - getCol()))
//			check if there's no friend piece in its way
			if (!hasPieceBetween(row, col))
				return true;
		return false;
	}

	@Override
	public boolean canMove(int row, int col)
	{
		if (!super.canMove(row, col))
			return false;
//		check if destination is in range
		if (!Utils.inRange(row, col))
			return false;
//		check if there's no piece on destination
		if (board.getPieceAt(row, col) != null)
			return false;
//		check if it's a diagonal move
		if (Math.abs(row - getRow()) != Math.abs(col - getCol()))
			return false;
//		check if there's no friend piece in its way
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