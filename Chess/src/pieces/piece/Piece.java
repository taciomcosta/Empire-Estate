package pieces.piece;

import chessboard.Chessboard;
import chessboard.Utils;

public abstract class Piece
{
	public enum Color {BLACK, WHITE};
	public enum Icon {P, R, N, B, Q, K};
	
	public PieceModel model;
	protected Chessboard board;

	public Piece(Color color, Icon i, Chessboard b, int row, int col)  
	{
		setChessboard(b);
		model = new PieceModel(color, i, row, col);
		b.addPiece(this, row, col);
	}
	
	void setChessboard(Chessboard b)
	{
		this.board = b;
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
	
	public int getFirstCol()
	{
		return model.getFirstCol();
	}

	public int getLastRow()
	{
		return model.getLastRow();
	}
	
	public int getLastCol()
	{
		return model.getLastCol();
	}
	
	public void setPieceInitial(Icon i)
	{
		model.setPieceInitial(i);
	}
	
	public Icon getPieceInitial()
	{
		return model.getPieceInitial();
	}
	
	public int getMoves()
	{
		return model.getMoves();
	}

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
		return true;
	}

	public boolean canCapture(int row, int col)
	{
//		check if it's captured
		if (isCaptured())
			return false;
//		if it's an empty cell, then it's considered capturable
		if (board.getPieceAt(row, col) == null)
			return true;
//		check colors 
		if (board.getPieceAt(row, col).getColor() == getColor())
			return false;
		return true;
	}
	
	public boolean[][] get_capture_route(Piece enemy)
	{
//		initialize map
		boolean[][] map = new boolean[8][8];
		for (int i = 0; i < Utils.BOARD_LENGTH; i++)
			for (int j = 0; j < Utils.BOARD_LENGTH; j++)
				map[i][j] = false;
//		get attack target
		int enemyRow = enemy.getRow();
		int enemyCol = enemy.getCol();
//		set direction of attack
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
		int i = getRow();
		int j = getCol();
		while (i != enemyRow && j != enemyCol) {
			map[i][j] = true;
			i += rowDirection;
			j += colDirection;
		}
//		make start position true
		map[getRow()][getCol()] = true;
//		make start position true
		map[enemyRow][enemyCol] = false;
		return map;
	}

	public void increaseMove()
	{
		++model.moves;
	}

	public void decreaseMove()
	{
		--model.moves;
	}
}
