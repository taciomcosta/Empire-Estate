package pieces;

import pieces.piece.Piece;
import chessboard.Chessboard;
import chessboard.Utils;

public class Queen extends Piece
{
	public Queen(Color color, Chessboard b, int row, int col)
	{
		super(color, Icon.Q, b, row, col);
	}

	@Override
	public void capture(Piece pieceToCapture)
	{
		int enemyRow = pieceToCapture.getRow();
		int enemyCol = pieceToCapture.getCol();
//		capture straight
		if (canCapture(enemyRow, enemyCol))
			super.capture(pieceToCapture);
	}
	
	@Override
	public boolean canMove(int row, int col)
	{
		if (!super.canMove(row, col))
			return false;
//		check if destination is in range
		if (!Utils.inRange(row, col))
			return false;
//		check if there's piece on destination
		if (board.getPieceAt(row, col) != null)
			return false;
//		check if it's a valid move for queen
		boolean p = getRow() == row || getCol() == col;
		boolean q = Math.abs(getCol() - col) == Math.abs(row - getRow());
		boolean r = !has_piece_in_its_way(row, col);
		if ((p || q) && r)
		        return true;
//		return false by default
		return false;
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
//		check if it's a valid move for queen
		boolean p = getRow() == row || getCol() == col;
		boolean q = Math.abs(getCol() - col) == Math.abs(row - getRow());
		boolean r = !has_piece_in_its_way(row, col);
		if ((p || q) && r)
		        return  true;
//		return false by default
		return false;
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
	private boolean has_piece_in_its_way(int finalRow, int finalCol)
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
//		increase for disconsidering the final position itself
		finalRow += rowDirection;
		finalCol += colDirection;
//		check if there's a piece in [startPosition; position [
		while (finalRow != startRow && finalCol != startCol) {
			if (board.getPieceAt(finalRow, finalCol) != null) {
				return true;
			}
			finalRow += rowDirection;
			finalCol += colDirection;
		}
//		if there's no piece
		return false;
	}
}