package pieces.piece;

import pieces.piece.Piece.Color;
import pieces.piece.Piece.Icon;

public class PieceModel
{
	private Color color;
	private Icon pieceInitial;
	private int row;
	private int col;
	private int firstRow;
	private int firstCol;
	private int lastRow;
	private int lastCol;
	int moves = 0;
	private boolean captured = false;
	
	public PieceModel(Color color, Icon i, int row, int col)  
	{
		setColor(color);
		setPieceInitial(i);
		setRow(row);
		setCol(col);
		setFirstPosition(row, col);
		setLastPosition(row, col);
	}
	

	public void setColor(Color color)
	{
		this.color = color;
	}
	
	public Color getColor()
	{
		return this.color;
	}
	
	public void setRow(int row)
	{
		this.row = row;
	}
	
	public int getRow()
	{
		return this.row;
	}
	
	public void setCol(int col)
	{
		this.col = col;
	}
	
	public int getCol()
	{
		return this.col;
	}
	
	void setFirstPosition(int firstRow, int firstCol)
	{
		this.firstRow = firstRow;
		this.firstCol = firstCol;
	}

	void setLastPosition(int lastRow, int lastCol)
	{
		this.lastRow = lastRow;
		this.lastCol = lastCol;
	}
	
	public int getFirstRow()
	{
		return this.firstRow;
	}
	
	public int getFirstCol()
	{
		return this.firstCol;
	}

	public int getLastRow()
	{
		return this.lastRow;
	}
	
	public int getLastCol()
	{
		return this.lastCol;
	}
	
	public void setPieceInitial(Icon i)
	{
		this.pieceInitial = i;
	}
	
	public Icon getPieceInitial()
	{
		return this.pieceInitial;
	}
	
	public int getMoves()
	{
		return this.moves;
	}
	
	public void setCaptured(boolean b)
	{
		this.captured = b;
	}
	
	public boolean isCaptured()
	{
		return this.captured;
	}
	
	public String toString()
	{
		if (getColor() == Color.BLACK)
			return getPieceInitial().toString().toUpperCase();
		if (getColor() == Color.WHITE)
			return getPieceInitial().toString().toLowerCase();
		return "-";
	}
}