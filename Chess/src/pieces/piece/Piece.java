package pieces.piece;

import chessboard.Chessboard;
import chessboard.Utils;

public abstract class Piece
{
	public enum Color {BLACK, WHITE};
	public enum Icon {P, R, N, B, Q, K};
	
	public PieceModel model;
	protected Chessboard board;

	public Piece(Color color, Icon icon, Chessboard board, int row, int col,
		     int value)
	{
		this.board = board;
		model = new PieceModel(color, icon, row, col, value);
		board.addPiece(this, row, col);
	}
	
	public void setColor(Color color)
	{
		model.setColor(color);
	}
	
	public Color getColor()
	{
		return model.getColor();
	}
	
	public void setRow(int row)
	{
		model.setRow(row);
	}
	
	public int getRow()
	{
		return model.getRow();
	}
	
	public void setCol(int col)
	{
		model.setCol(col);
	}
	
	public int getCol()
	{
		return model.getCol();
	}
	
	public int getFirstRow()
	{
		return model.getFirstRow();
	}
	
	public Icon getPieceInitial()
	{
		return model.getPieceInitial();
	}
	
	public int getMoves()
	{
		return model.getMoves();
	}

	public int getValue() { return model.getValue(); }

	public void setCaptured(boolean b)
	{
		model.setCaptured(b);
	}
	
	public boolean isCaptured()
	{
		return model.isCaptured();
	}
	
	public String toString()
	{
		return model.toString();
	}

	public void move(int row, int col)
	{
		model.setLastPosition(getRow(), getCol());
		board.removePiece(getRow(), getCol());
		board.addPiece(this, row, col);
		model.setRow(row);
		model.setCol(col);
		model.moves++;
	}

	public boolean hasSameColor(Piece p2)
	{
		if (p2.getColor() != getColor())
			return false;
		return true;
	}

	public boolean hasSameColor(Color c)
	{
		if (c != getColor())
			return false;
		return true;
	}
	
	
	public void capture(Piece pieceToCapture)
	{
		int enemyRow = pieceToCapture.getRow();
		int enemyCol = pieceToCapture.getCol();
		if (!hasSameColor(pieceToCapture)) {
//			remove captured piece
			board.removePiece(enemyRow, enemyCol);
			pieceToCapture.setCaptured(true);
//			move this to captured pieces' position
			model.setLastPosition(getRow(), getCol());
			board.removePiece(getRow(), getCol());
			board.addPiece(this, enemyRow, enemyCol);
			model.setRow(enemyRow);
			model.setCol(enemyCol);
			model.moves++;
			pieceToCapture.unsetPositionFromBoardRange();
		}
	}

	public void unsetPositionFromBoardRange()
	{
		setRow(Integer.MIN_VALUE);
		setCol(Integer.MIN_VALUE);
	}
	
	public boolean canMove(int row, int col)
	{
		if (isCaptured())
			return false;
		if (row == getRow() && col == getCol())
			return false;
		return true;
	}

	public boolean canCapture(int row, int col)
	{
//		TODO Utils.inRange() should go here???
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

	public void increaseMoves()
	{
		++model.moves;
	}

	public void decreaseMoves()
	{
		--model.moves;
	}
}
