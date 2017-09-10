package chessboard.cell;

import pieces.piece.Piece;

public class CellModel
{
	private Piece piece = null;

	//constructor
	public CellModel()
	{}
	
	public CellModel(Piece pice)
	{
		setPiece(piece);
	}

	// setters and getters
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
