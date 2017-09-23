package chessboard.cell;

import pieces.piece.Piece;

public class CellModel
{
	private Piece piece = null;

	public void setPiece(Piece p)
	{
		this.piece = p;
	}
	
	public Piece getPiece()
	{
		return this.piece;
	}
	
	public void unsetPiece()
	{
		this.piece = null;
	}
}
