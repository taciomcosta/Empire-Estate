package pieces.piece;

import pieces.piece.Piece.Color;
import pieces.Icon;

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
	private int value;
	int moves = 0;
	private boolean captured = false;
	
	public PieceModel(Color color, Icon i, int row, int col, int value)
	{
		this.color = color;
		this.pieceInitial = i;
		this.row = row;
		this.col = col;
		this.value = value;
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
	
	public Icon getPieceInitial()
	{
		return this.pieceInitial;
	}
	
	public int getMoves()
	{
		return this.moves;
	}

	public int getValue() { return this.value; }

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
		String ANSI_RESET = "\u001B[0m";
		String ANSI_RED = "\u001B[31m";
		String ANSI_GREEN = "\u001B[32m";
		if (getColor() == Color.BLACK)
			return ANSI_RED +
				getPieceInitial().toString().toUpperCase() +
				ANSI_RESET;
		if (getColor() == Color.WHITE)
			return ANSI_GREEN +
				getPieceInitial().toString().toLowerCase() +
				ANSI_RESET;
		return "-";
	}
}