package player;

import pieces.piece.Piece;

public class Move
{
        private int startRow;
        private int startCol;
        private int finalRow;
        private int finalCol;
        private Piece piece;
        private Piece capturedPiece;
        private char type;

        public Move(Piece p, char type, int finalRow, int finalCol)
        {
                this.piece = p;
                this.startRow = p.getRow();
                this.startCol = p.getCol();
                this.type = type;
                this.finalRow = finalRow;
                this.finalCol = finalCol;
        }

        public Piece getPiece()
        {
                return this.piece;
        }

        public int getStartRow()
        {
                return this.startRow;
        }

        public int getStartCol()
        {
                return this.startCol;
        }

        public int getFinalRow()
        {
                return this.finalRow;
        }

        public int getFinalCol()
        {
                return this.finalCol;
        }

        public char getType() { return this.type; }

        public void setCapturedPiece(Piece p)
        {
                this.capturedPiece = p;
        }

        public Piece getCapturedPiece()
        {
                return this.capturedPiece;
        }
}
