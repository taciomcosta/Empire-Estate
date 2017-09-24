package chessboard;

import pieces.Piece;

public final class Tile
{
	private Piece piece = null;

	public void setPiece(Piece piece)
	{
		this.piece = piece;
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
