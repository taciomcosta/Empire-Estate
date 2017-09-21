package tests;

import chessboard.Utils;
import org.junit.Test;
import pieces.Knight;
import pieces.piece.Piece;

import java.util.ArrayList;

import static junit.framework.Assert.assertTrue;

public class KnightTest extends tests.Test
{
        private Knight knight;

        @Test
        public void testCanCaptureAndCanMove()
        {
                setUp1();
                board.printModel();
                assertTrue(captureTestShouldReturnTrue1());
                setUp3();
                board.printModel();
                assertTrue(moveTestShouldReturnTrue3());
        }

        public void setUp1()
        {
                resetElements();
                removePieces1();
                setPositions1();
        }

        public void removePieces1()
        {
                ArrayList<Piece.Icon> whitePiecesIcon = whiteTestSet1();
                ArrayList<Piece.Icon> blackPiecesIcon = blackTestSet1();
                removePiecesDifferent(whitePlayer, whitePiecesIcon);
                removePiecesDifferent(blackPlayer, blackPiecesIcon);
                removePiece(whitePlayer.pieces[13]);
        }

        public void setPositions1()
        {
                movePiece(knight, 4,3);
                movePiece(whitePlayer.pieces[15], 6, 4);
                movePiece(blackPlayer.pieces[10], 2, 4);
                movePiece(blackPlayer.pieces[11], 3, 3);
        }

        public ArrayList<Piece.Icon> whiteTestSet1()
        {
                ArrayList<Piece.Icon> icons = new ArrayList<>();
                icons.add(Piece.Icon.N);
                icons.add(Piece.Icon.K);
                return icons;
        }

        public ArrayList<Piece.Icon> blackTestSet1()
        {
                ArrayList<Piece.Icon> icons = new ArrayList<>();
                icons.add(Piece.Icon.B);
                return icons;
        }

        public boolean captureTestShouldReturnTrue1()
        {
                boolean[][] testMap = {
                        {false, false, false, false, false, false, false, false},
                        {false, false, false, false, false, false, false, false},
                        {false, false, true,  false, true,  false, false, false},
                        {false, true,  false, false, false, true,  false, false},
                        {false, false, false, false, false, false, false, false},
                        {false, true,  false, false, false, true,  false, false},
                        {false, false, true,  false, false, false, false, false},
                        {false, false, false, false, false, false, false, false},
                };
                boolean[][] currentMap = getCaptureMap(knight);
                for (int i = 0; i < Utils.BOARD_LENGTH; ++i)
                        for (int j = 0; j < Utils.BOARD_LENGTH; ++j)
                                if (testMap[i][j] != currentMap[i][j])
                                        return false;
                return true;
        }

        public void setUp3()
        {
                resetElements();
                removePieces3();
                setPositions3();
        }

        public void removePieces3()
        {
                ArrayList<Piece.Icon> whitePiecesIcon = whiteTestSet3();
                ArrayList<Piece.Icon> blackPiecesIcon = blackTestSet3();
                removePiecesDifferent(whitePlayer, whitePiecesIcon);
                removePiecesDifferent(blackPlayer, blackPiecesIcon);
                removePiece(whitePlayer.pieces[13]);
        }

        public void setPositions3()
        {
                movePiece(knight, 4, 3);
                movePiece(blackPlayer.pieces[15], 2, 4);
                movePiece(whitePlayer.pieces[15], 6, 4);
        }

        public ArrayList<Piece.Icon> whiteTestSet3()
        {
                ArrayList<Piece.Icon> icons = new ArrayList<>();
                icons.add(Piece.Icon.N);
                icons.add(Piece.Icon.K);
                return icons;
        }

        public ArrayList<Piece.Icon> blackTestSet3()
        {
                ArrayList<Piece.Icon> icons = new ArrayList<>();
                icons.add(Piece.Icon.K);
                return icons;
        }

        public boolean moveTestShouldReturnTrue3()
        {
                boolean[][] testMap = {
                        {false, false, false, false, false, false, false, false},
                        {false, false, false, false, false, false, false, false},
                        {false, false, true,  false, false, false, false, false},
                        {false, true,  false, false, false, true,  false, false},
                        {false, false, false, false, false, false, false, false},
                        {false, true,  false, false, false, true,  false, false},
                        {false, false, true,  false, false, false, false, false},
                        {false, false, false, false, false, false, false, false},
                };
                boolean[][] currentMap = getMoveMap(knight);
                for (int i = 0; i < Utils.BOARD_LENGTH; ++i)
                        for (int j = 0; j < Utils.BOARD_LENGTH; ++j)
                                if (testMap[i][j] != currentMap[i][j])
                                        return false;
                return true;
        }

        @Override
        public void resetElements()
        {
                super.resetElements();
                knight = (Knight) whitePlayer.pieces[12];
        }
}
