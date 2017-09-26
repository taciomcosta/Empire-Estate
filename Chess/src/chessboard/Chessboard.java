package chessboard;

import pieces.Piece;

public final class Chessboard
{
	private Tile[][] tiles;
	private Piece lastMovedPiece;

        public Chessboard()
        {
        	tiles = new Tile[Utils.BOARD_LENGTH][Utils.BOARD_LENGTH];
        	for (int i = 0; i < Utils.BOARD_LENGTH; i++) {
        		for (int j = 0; j < Utils.BOARD_LENGTH; j++) {
        			tiles[i][j] = new Tile();
        		}
		}
        }
        
        public void addPiece(Piece p, int row, int col)
        {
        	tiles[row][col].setPiece(p);
        }
        
        public void removePiece(int row, int col)
        {
        	tiles[row][col].unsetPiece();
        }
        
        public Piece getPieceAt(int row, int col)
        {
        	return tiles[row][col].getPiece();
        }

        public void setLastMovedPiece(Piece piece)
	{
		this.lastMovedPiece = piece;
	}

	public Piece getLastMovedPiece()
	{
		return this.lastMovedPiece;
	}
        
	public void print()
	{
		for (int i = 0; i < Utils.BOARD_LENGTH; i++) {
			System.out.print((8 - i) + " | ");
			for (int j = 0; j < Utils.BOARD_LENGTH; j++) {
				Piece p = tiles[i][j].getPiece();
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
