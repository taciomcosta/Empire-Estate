package chessboard;

import pieces.piece.Piece;
import chessboard.cell.CellModel;
import chessboard.Utils;

import javax.rmi.CORBA.Util;

public class ChessboardModel
{
	private CellModel[][] cells;
	
	public ChessboardModel()
	{
		cells = new CellModel[Utils.BOARD_LENGTH][Utils.BOARD_LENGTH];
	}
	
	public void setCell(CellModel cell, int row, int col)
	{
		cells[row][col] = cell;
	}

	public char[][] getState()
	{
		char[][] board =
			new char[Utils.BOARD_LENGTH][Utils.BOARD_LENGTH];
		for (int i = 0; i < Utils.BOARD_LENGTH; ++i) {
			for (int j = 0; j < Utils.BOARD_LENGTH; ++j) {
				Piece p = cells[i][j].getPiece();
				if (p != null)
				        board[i][j] = p.toString().charAt(0);
				else
				        board[i][j] = '-';
			}
		}
		return board;
	}
	
	public void print()
	{
		for (int i = 0; i < Utils.BOARD_LENGTH; i++) {
			System.out.print((8 - i) + " | ");
			for (int j = 0; j < Utils.BOARD_LENGTH; j++) {
				Piece p = cells[i][j].getPiece();
				if (p != null)
					System.out.print(p.toString() + " ");
				else
					System.out.print("- ");
			}
			System.out.println();
		}
		System.out.println("   -----------------");
		System.out.println("    a b c d e f g h\n");
	}
}
