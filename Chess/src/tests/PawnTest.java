package tests;

import chessboard.Utils;
import org.junit.Test;
import pieces.Pawn;
import pieces.piece.Piece;

import java.util.ArrayList;

import static junit.framework.Assert.assertTrue;

public class PawnTest extends tests.Test
{
        private Pawn pawn;

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
                setUp4();
                board.printModel();
                assertTrue(moveTestShouldReturnTrue4());
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
                for (int i = 1; i < 8; ++i)
                        removePiece(whitePlayer.pieces[i]);
        }

        public void setPositions1()
        {
                movePiece(pawn, 4,4);
                movePiece(whitePlayer.pieces[14], 3, 5);
                movePiece(blackPlayer.pieces[15], 3, 3);
                movePiece(blackPlayer.pieces[8], 5, 3);
                movePiece(blackPlayer.pieces[9], 4, 5);
        }

        public ArrayList<Piece.Icon> whiteTestSet1()
        {
                ArrayList<Piece.Icon> icons = new ArrayList<>();
                icons.add(Piece.Icon.P);
                icons.add(Piece.Icon.Q);
                return icons;
        }

        public ArrayList<Piece.Icon> blackTestSet1()
        {
                ArrayList<Piece.Icon> icons = new ArrayList<>();
                icons.add(Piece.Icon.K);
                icons.add(Piece.Icon.R);
                return icons;
        }

        public boolean captureTestShouldReturnTrue1()
        {
                boolean[][] testMap = {
                        {false, false, false, false, false, false, false, false},
                        {false, false, false, false, false, false, false, false},
                        {false, false, false, false, false, false, false, false},
                        {false, false, false, true, false, false, false, false},
                        {false, false, false, false, false, false, false, false},
                        {false, false, false, false, false, false, false, false},
                        {false, false, false, false, false, false, false, false},
                        {false, false, false, false, false, false, false, false},
                };
                boolean[][] currentMap = getCaptureMap(pawn);
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
                for (int i = 1; i < 8; ++i) {
                        removePiece(whitePlayer.pieces[i]);
                        removePiece(blackPlayer.pieces[i]);
                }
        }

        public void setPositions2()
        {
                movePiece(whitePlayer.pieces[0], 4, 0);
                movePiece(blackPlayer.pieces[0], 4, 1);
                movePiece(blackPlayer.pieces[8], 2, 2);
                movePiece(blackPlayer.pieces[9], 2, 2);
        }

        public ArrayList<Piece.Icon> whiteTestSet2()
        {
                ArrayList<Piece.Icon> icons = new ArrayList<>();
                icons.add(Piece.Icon.P);
                return icons;
        }

        public ArrayList<Piece.Icon> blackTestSet2()
        {
                ArrayList<Piece.Icon> icons = new ArrayList<>();
                icons.add(Piece.Icon.R);
                icons.add(Piece.Icon.P);
                return icons;
        }

        public boolean captureTestShouldReturnTrue2()
        {
                boolean[][] testMap = {
                        {false, false, false, false, false, false, false, false},
                        {false, false, false, false, false, false, false, false},
                        {false, false, false, false, false, false, false, false},
                        {false, true, false, false, false, false, false, false},
                        {false, true, false, false, false, false, false, false},
                        {false, false, false, false, false, false, false, false},
                        {false, false, false, false, false, false, false, false},
                        {false, false, false, false, false, false, false, false},
                };
                boolean[][] currentMap = getCaptureMap(pawn);
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
        }

        public void removePieces3()
        {
                ArrayList<Piece.Icon> whitePiecesIcon = whiteTestSet3();
                ArrayList<Piece.Icon> blackPiecesIcon = blackTestSet3();
                removePiecesDifferent(whitePlayer, whitePiecesIcon);
                removePiecesDifferent(blackPlayer, blackPiecesIcon);
                for (int i = 1; i < 8; ++i)
                        removePiece(whitePlayer.pieces[i]);
        }

        public ArrayList<Piece.Icon> whiteTestSet3()
        {
                ArrayList<Piece.Icon> icons = new ArrayList<>();
                icons.add(Piece.Icon.P);
                return icons;
        }

        public ArrayList<Piece.Icon> blackTestSet3()
        {
                ArrayList<Piece.Icon> icons = new ArrayList<>();
                return icons;
        }

        public boolean moveTestShouldReturnTrue3()
        {
                boolean[][] testMap = {
                        {false, false, false, false, false, false, false, false},
                        {false, false, false, false, false, false, false, false},
                        {false, false, false, false, false, false, false, false},
                        {false, false, false, false, false, false, false, false},
                        {true, false, false, false, false, false, false, false},
                        {true, false, false, false, false, false, false, false},
                        {false, false, false, false, false, false, false, false},
                        {false, false, false, false, false, false, false, false},
                };
                boolean[][] currentMap = getMoveMap(pawn);
                for (int i = 0; i < Utils.BOARD_LENGTH; ++i)
                        for (int j = 0; j < Utils.BOARD_LENGTH; ++j)
                                if (testMap[i][j] != currentMap[i][j])
                                        return false;
                return true;
        }

        public void setUp4()
        {
                resetElements();
                removePieces4();
                setPositions4();
        }

        public void removePieces4()
        {
                ArrayList<Piece.Icon> whitePiecesIcon = whiteTestSet4();
                ArrayList<Piece.Icon> blackPiecesIcon = blackTestSet4();
                removePiecesDifferent(whitePlayer, whitePiecesIcon);
                removePiecesDifferent(blackPlayer, blackPiecesIcon);
                for (int i = 1; i < 8; ++i)
                        removePiece(whitePlayer.pieces[i]);
        }

        public void setPositions4()
        {
                movePiece(blackPlayer.pieces[15], 5,0);
        }

        public ArrayList<Piece.Icon> whiteTestSet4()
        {
                ArrayList<Piece.Icon> icons = new ArrayList<>();
                icons.add(Piece.Icon.P);
                return icons;
        }

        public ArrayList<Piece.Icon> blackTestSet4()
        {
                ArrayList<Piece.Icon> icons = new ArrayList<>();
                icons.add(Piece.Icon.K);
                return icons;
        }

        public boolean moveTestShouldReturnTrue4()
        {
                boolean[][] testMap = {
                        {false, false, false, false, false, false, false, false},
                        {false, false, false, false, false, false, false, false},
                        {false, false, false, false, false, false, false, false},
                        {false, false, false, false, false, false, false, false},
                        {false, false, false, false, false, false, false, false},
                        {false, false, false, false, false, false, false, false},
                        {false, false, false, false, false, false, false, false},
                        {false, false, false, false, false, false, false, false},
                };
                boolean[][] currentMap = getMoveMap(pawn);
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
                pawn = (Pawn) whitePlayer.pieces[0];
        }
}
