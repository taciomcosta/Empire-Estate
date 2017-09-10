package chessboard;

import chessboard.cell.Cell;

import pieces.piece.Piece;

public final class Chessboard
{
	private ChessboardModel model;
	private Cell[][] cells;

        public Chessboard()
        {
        	model = new ChessboardModel();
        	cells = new Cell[Utils.BOARD_LENGTH][Utils.BOARD_LENGTH];
//        	initialize empty cells and add them to chessboard model
        	for (int i = 0; i < Utils.BOARD_LENGTH; i++) {
        		for (int j = 0; j < Utils.BOARD_LENGTH; j++) {
        			cells[i][j] = new Cell();
        			model.setCell(cells[i][j].getModel(), i, j);
        		}
		}
        }
        
        public void addPiece(Piece p, int row, int col)
        {
        	cells[row][col].setPiece(p);
        }
        
        public void removePiece(int row, int col)
        {
//        	remove piece from cell
        	cells[row][col].unsetPiece();
        }
        
        public Piece getPieceAt(int row, int col)
        {
        	if (!Utils.inRange(row, col))
        		return null;
        	return cells[row][col].getPiece();
        }
        
        public void printModel()
        {
        	model.print();
        }

        public char[][] getModel()
	{
		return model.getState();
	}
}
