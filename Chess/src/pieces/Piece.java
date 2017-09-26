package pieces;

import chessboard.Chessboard;
import chessboard.Utils;

public abstract class Piece
{
	public enum Color {BLACK, WHITE}

	protected Chessboard board;
	private Color color;
	private Icon pieceInitial;
	private int row;
	private int col;
	private int firstRow;
	private int firstCol;
	private int value;
	int moves = 0;
	private boolean captured = false;

	public Piece(Color color, Icon icon, Chessboard board, int row, int col,
		     int value)
	{
		this.board = board;
		this.color = color;
		this.pieceInitial = icon;
		this.row = row;
		this.col = col;
		this.firstRow = row;
		this.firstCol = col;
		this.value = value;
		board.addPiece(this, row, col);
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

	public void increaseMoves()
	{
		++this.moves;
	}

	public void decreaseMoves()
	{
		--this.moves;
	}

	public void move(int row, int col)
	{
		board.removePiece(getRow(), getCol());
		board.addPiece(this, row, col);
		setRow(row);
		setCol(col);
		increaseMoves();
	}

	public boolean hasSameColor(Piece piece)
	{
		return piece.getColor() == getColor();
	}

	public boolean hasSameColor(Color c)
	{
	        return c == getColor();
	}
	
	public void capture(Piece pieceToCapture)
	{
		int enemyRow = pieceToCapture.getRow();
		int enemyCol = pieceToCapture.getCol();
                board.removePiece(enemyRow, enemyCol);
                pieceToCapture.setCaptured(true);
		pieceToCapture.unsetPositionFromBoardRange();
                board.removePiece(getRow(), getCol());
                board.addPiece(this, enemyRow, enemyCol);
                setRow(enemyRow);
                setCol(enemyCol);
                increaseMoves();
	}

	public void unsetPositionFromBoardRange()
	{
		setRow(Integer.MIN_VALUE);
		setCol(Integer.MIN_VALUE);
	}
	
	public boolean canMove(int row, int col)
	{
		if (!Utils.inRange(row, col))
			return false;
		if (isCaptured())
			return false;
		if (row == getRow() && col == getCol())
			return false;
		return true;
	}

	public boolean canCapture(int row, int col)
	{
		if (!Utils.inRange(row, col))
			return false;
		if (isCaptured())
			return false;
		if (row == getRow() && col == getCol())
			return false;
		if (board.getPieceAt(row, col) == null)
			return true;
		if (board.getPieceAt(row, col).getColor() == getColor())
			return false;
		return true;
	}
	
	public boolean[][] getAttackingRoute(Piece enemy)
	{
		boolean[][] map = new boolean[8][8];
		for (int i = 0; i < Utils.BOARD_LENGTH; i++)
			for (int j = 0; j < Utils.BOARD_LENGTH; j++)
				map[i][j] = false;
		int enemyRow = enemy.getRow();
		int enemyCol = enemy.getCol();
		int rowDirection = 0;
		int colDirection = 0;
		if (getRow() > enemyRow)
			rowDirection = -1;
		else if (getRow() < enemyRow)
			rowDirection = 1;
		if (getCol() > enemyCol)
			colDirection = -1;
		else if (getCol() < enemyCol)
			colDirection = 1;
		int currentRow = getRow();
		int currentCol = getCol();
		while (currentRow != enemyRow && currentCol != enemyCol) {
			map[currentRow][currentCol] = true;
			currentRow += rowDirection;
			currentCol += colDirection;
		}
		return map;
	}

	@Override
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
