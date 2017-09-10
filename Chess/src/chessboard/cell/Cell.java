package chessboard.cell;

import pieces.piece.Piece;

public final class Cell
{
	private CellModel model;

	//constructor
	public Cell()
	{
		model = new CellModel();
	}
	
	// setters and getters
	public void setPiece(Piece p)
	{
		model.setPiece(p);
	}
	
	public Piece getPiece()
	{
		return model.getPiece();
	}
	
	public void unsetPiece()
	{
		model.unsetPiece();
	}
	
	public CellModel getModel()
	{
		return this.model;
	}
}
