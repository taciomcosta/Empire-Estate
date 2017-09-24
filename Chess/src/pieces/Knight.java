package pieces;

import pieces.piece.Piece;
import chessboard.Chessboard;
import chessboard.Utils;

public class Knight extends Piece 
{
	public Knight(Color color, Chessboard b, int row, int col)
	{
		super(color, Icon.N, b, row, col, 3);
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
		if (board.getPieceAt(row, col) != null)
			return false;
		int rowsDifference = Math.abs(getRow() - row);
		int colsDifference = Math.abs(getCol() - col);
		if (rowsDifference == 2 && colsDifference == 1)
			return true;
		if (rowsDifference == 1 && colsDifference == 2)
			return true;
		return false;
	}

	@Override
	public boolean canCapture(int row, int col)
	{
		if (!super.canCapture(row, col))
			return false;
		int rowsDifference = Math.abs(getRow() - row);
		int colsDifference = Math.abs(getCol() - col);
		if (rowsDifference == 2 && colsDifference == 1)
			return true;
		if (rowsDifference == 1 && colsDifference == 2)
			return true;
		return false;
	}
	
	@Override
	public void capture(Piece pieceToCapture)
	{
		int enemyRow = pieceToCapture.getRow();
		int enemyCol = pieceToCapture.getCol();
		if (canCapture(enemyRow, enemyCol))
			super.capture(pieceToCapture);
	}
}