package tests;

import chessboard.Utils;
import org.junit.Test;
import pieces.Icon;
import pieces.Pawn;

import java.util.ArrayList;

import static junit.framework.Assert.assertTrue;

public class PawnTest extends tests.Test
{
        private Pawn pawn;

        @Test
        public void testCanCaptureAndCanMove()
        {
                setUp1();
//                board.print();
                assertTrue(captureTestShouldReturnTrue());
                setUp2();
                board.print();
                assertTrue(captureEnPassantTestShouldReturnTrue());
                setUp3();
//                board.print();
                assertTrue(moveTestShouldReturnTrue3());
                setUp4();
//                board.print();
                assertTrue(moveTestShouldReturnTrue4());
        }

        private void setUp1()
        {
                resetElements();
                removePieces1();
                setPositions1();
        }

        private void removePieces1()
        {
                ArrayList<Icon> whitePiecesIcons = whiteTestSet1();
                ArrayList<Icon> blackPiecesIcons = blackTestSet1();
                removePiecesDifferent(whitePlayer, whitePiecesIcons);
                removePiecesDifferent(blackPlayer, blackPiecesIcons);
                for (int i = 1; i < 8; ++i)
                        removePiece(whitePlayer.pieces[i]);
        }

        private void setPositions1()
        {
                movePiece(pawn, 4,4);
                movePiece(whitePlayer.pieces[14], 3, 5);
                movePiece(blackPlayer.pieces[15], 3, 3);
                movePiece(blackPlayer.pieces[8], 5, 3);
                movePiece(blackPlayer.pieces[9], 4, 5);
        }

        private ArrayList<Icon> whiteTestSet1()
        {
                ArrayList<Icon> icons = new ArrayList<>();
                icons.add(Icon.P);
                icons.add(Icon.Q);
                return icons;
        }

        private ArrayList<Icon> blackTestSet1()
        {
                ArrayList<Icon> icons = new ArrayList<>();
                icons.add(Icon.K);
                icons.add(Icon.R);
                return icons;
        }

        private boolean captureTestShouldReturnTrue()
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
                                if (testMap[i][j] != currentMap[i][j]) {
                                        System.out.println(i + ", " + j);
                                        return false;
                                }
                return true;
        }

        private void setUp2()
        {
                resetElements();
                removePieces2();
                setPositions2();
        }

        private void removePieces2()
        {
                ArrayList<Icon> whitePiecesIcons = whiteTestSet2();
                ArrayList<Icon> blackPiecesIcons = blackTestSet2();
                removePiecesDifferent(whitePlayer, whitePiecesIcons);
                removePiecesDifferent(blackPlayer, blackPiecesIcons);
                for (int i = 1; i < 8; ++i) {
                        removePiece(whitePlayer.pieces[i]);
                        removePiece(blackPlayer.pieces[i]);
                }
                removePiece(blackPlayer.pieces[9]);
        }

        private void setPositions2()
        {
                movePiece(whitePlayer.pieces[0], 3, 1);
                movePiece(blackPlayer.pieces[0], 3, 0);
                movePiece(blackPlayer.pieces[8], 4, 3);
        }

        private ArrayList<Icon> whiteTestSet2()
        {
                ArrayList<Icon> icons = new ArrayList<>();
                icons.add(Icon.P);
                return icons;
        }

        private ArrayList<Icon> blackTestSet2()
        {
                ArrayList<Icon> icons = new ArrayList<>();
                icons.add(Icon.R);
                icons.add(Icon.P);
                return icons;
        }

        private boolean captureEnPassantTestShouldReturnTrue()
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

        private void setUp3()
        {
                resetElements();
                removePieces3();
        }

        private void removePieces3()
        {
                ArrayList<Icon> whitePiecesIcons = whiteTestSet3();
                ArrayList<Icon> blackPiecesIcons = blackTestSet3();
                removePiecesDifferent(whitePlayer, whitePiecesIcons);
                removePiecesDifferent(blackPlayer, blackPiecesIcons);
                for (int i = 1; i < 8; ++i)
                        removePiece(whitePlayer.pieces[i]);
        }

        private ArrayList<Icon> whiteTestSet3()
        {
                ArrayList<Icon> icons = new ArrayList<>();
                icons.add(Icon.P);
                return icons;
        }

        private ArrayList<Icon> blackTestSet3()
        {
                return new ArrayList<>();
        }

        private boolean moveTestShouldReturnTrue3()
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

        private void setUp4()
        {
                resetElements();
                removePieces4();
                setPositions4();
        }

        private void removePieces4()
        {
                ArrayList<Icon> whitePiecesIcons = whiteTestSet4();
                ArrayList<Icon> blackPiecesIcons = blackTestSet4();
                removePiecesDifferent(whitePlayer, whitePiecesIcons);
                removePiecesDifferent(blackPlayer, blackPiecesIcons);
                for (int i = 1; i < 8; ++i)
                        removePiece(whitePlayer.pieces[i]);
        }

        private void setPositions4()
        {
                movePiece(blackPlayer.pieces[15], 5,0);
        }

        private ArrayList<Icon> whiteTestSet4()
        {
                ArrayList<Icon> icons = new ArrayList<>();
                icons.add(Icon.P);
                return icons;
        }

        private ArrayList<Icon> blackTestSet4()
        {
                ArrayList<Icon> icons = new ArrayList<>();
                icons.add(Icon.K);
                return icons;
        }

        private boolean moveTestShouldReturnTrue4()
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
