package tests;

import chessboard.Utils;
import org.junit.Test;
import pieces.Bishop;
import pieces.piece.Piece;

import java.util.ArrayList;

import static junit.framework.Assert.assertTrue;

public class BishopTest extends tests.Test
{
        private Bishop bishop;

        @Test
        public void testCanCaptureAndCanMove()
        {
                setUp1();
                board.printModel();
                assertTrue(captureTestShouldReturnTrue1());
                setUp2();
                board.printModel();
                assertTrue(captureTestShouldReturnTrue2());
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
                removePiece(whitePlayer.pieces[11]);
        }

        public void setPositions1()
        {
                movePiece(bishop, 4,3);
                movePiece(blackPlayer.pieces[8], 1, 6);
                movePiece(blackPlayer.pieces[9], 5, 2);
        }

        public ArrayList<Piece.Icon> whiteTestSet1()
        {
                ArrayList<Piece.Icon> icons = new ArrayList<>();
                icons.add(Piece.Icon.B);
                return icons;
        }

        public ArrayList<Piece.Icon> blackTestSet1()
        {
                ArrayList<Piece.Icon> icons = new ArrayList<>();
                icons.add(Piece.Icon.R);
                return icons;
        }

        public boolean captureTestShouldReturnTrue1()
        {
                boolean[][] testMap = {
                        {false, false, false, false,  false, false, false, false},
                        {true,  false, false, false,  false, false, true,  false},
                        {false, true,  false, false,  false, true,  false, false},
                        {false, false, true,  false,  true,  false, false, false},
                        {false, false, false, false,  false, false, false, false},
                        {false, false, true,  false,  true,  false, false, false},
                        {false, false, false, false,  false, true,  false, false},
                        {false, false, false, false,  false, false, true,  false},
                };
                boolean[][] currentMap = getCaptureMap(bishop);
                for (int i = 0; i < Utils.BOARD_LENGTH; ++i)
                        for (int j = 0; j < Utils.BOARD_LENGTH; ++j)
                                if (testMap[i][j] != currentMap[i][j])
                                        return false;
                return true;
        }

        public void setUp2()
        {
                resetElements();
                removePieces2();
                setPositions2();
        }

        public void removePieces2()
        {
                ArrayList<Piece.Icon> whitePiecesIcon = whiteTestSet2();
                ArrayList<Piece.Icon> blackPiecesIcon = blackTestSet2();
                removePiecesDifferent(whitePlayer, whitePiecesIcon);
                removePiecesDifferent(blackPlayer, blackPiecesIcon);
                removePiece(whitePlayer.pieces[11]);
        }

        public void setPositions2()
        {
                movePiece(bishop, 4, 3);
                movePiece(whitePlayer.pieces[14], 0, 7);
                movePiece(whitePlayer.pieces[15], 5, 2);
        }

        public ArrayList<Piece.Icon> whiteTestSet2()
        {
                ArrayList<Piece.Icon> icons = new ArrayList<>();
                icons.add(Piece.Icon.B);
                icons.add(Piece.Icon.K);
                icons.add(Piece.Icon.Q);
                return icons;
        }

        public ArrayList<Piece.Icon> blackTestSet2()
        {
                ArrayList<Piece.Icon> icons = new ArrayList<>();
                return icons;
        }

        public boolean captureTestShouldReturnTrue2()
        {
                boolean[][] testMap = {
                        {false, false, false, false,  false, false, false, false},
                        {true,  false, false, false,  false, false, true,  false},
                        {false, true,  false, false,  false, true,  false, false},
                        {false, false, true,  false,  true,  false, false, false},
                        {false, false, false, false,  false, false, false, false},
                        {false, false, false, false,  true,  false, false, false},
                        {false, false, false, false,  false, true,  false, false},
                        {false, false, false, false,  false, false, true,  false},
                };
                boolean[][] currentMap = getCaptureMap(bishop);
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
                removePiece(whitePlayer.pieces[11]);
        }

        public void setPositions3()
        {
                movePiece(bishop, 4, 3);
                movePiece(whitePlayer.pieces[15], 5, 2);
                movePiece(blackPlayer.pieces[15], 1, 6);
        }

        public ArrayList<Piece.Icon> whiteTestSet3()
        {
                ArrayList<Piece.Icon> icons = new ArrayList<>();
                icons.add(Piece.Icon.B);
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
                        {true,  false, false, false, false, false, false, false},
                        {false, true,  false, false, false, true,  false, false},
                        {false, false, true,  false, true,  false, false, false},
                        {false, false, false, false, false, false, false, false},
                        {false, false, false, false, true,  false, false, false},
                        {false, false, false, false, false, true,  false, false},
                        {false, false, false, false, false, false, true,  false},
                };
                boolean[][] currentMap = getMoveMap(bishop);
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
                bishop = (Bishop) whitePlayer.pieces[10];
        }
}
