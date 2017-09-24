package tests;

import chessboard.Utils;
import org.junit.Test;
import pieces.Bishop;
import pieces.Icon;

import java.util.ArrayList;

import static junit.framework.Assert.assertTrue;

public class BishopTest extends tests.Test
{
        private Bishop bishop;

        @Test
        public void testCanCaptureAndCanMove()
        {
                setUp1();
//                board.printModel();
                assertTrue(captureTestShouldReturnTrue1());
                setUp2();
//                board.printModel();
                assertTrue(captureTestShouldReturnTrue2());
                setUp3();
//                board.printModel();
                assertTrue(moveTestShouldReturnTrue3());
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
                removePiece(whitePlayer.pieces[11]);
        }

        private void setPositions1()
        {
                movePiece(bishop, 4,3);
                movePiece(blackPlayer.pieces[8], 1, 6);
                movePiece(blackPlayer.pieces[9], 5, 2);
        }

        private ArrayList<Icon> whiteTestSet1()
        {
                ArrayList<Icon> icons = new ArrayList<>();
                icons.add(Icon.B);
                return icons;
        }

        private ArrayList<Icon> blackTestSet1()
        {
                ArrayList<Icon> icons = new ArrayList<>();
                icons.add(Icon.R);
                return icons;
        }

        private boolean captureTestShouldReturnTrue1()
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
                removePiece(whitePlayer.pieces[11]);
        }

        private void setPositions2()
        {
                movePiece(bishop, 4, 3);
                movePiece(whitePlayer.pieces[14], 0, 7);
                movePiece(whitePlayer.pieces[15], 5, 2);
        }

        private ArrayList<Icon> whiteTestSet2()
        {
                ArrayList<Icon> icons = new ArrayList<>();
                icons.add(Icon.B);
                icons.add(Icon.K);
                icons.add(Icon.Q);
                return icons;
        }

        private ArrayList<Icon> blackTestSet2()
        {
                return new ArrayList<>();
        }

        private boolean captureTestShouldReturnTrue2()
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

        private void setUp3()
        {
                resetElements();
                removePieces3();
                setPositions3();
        }

        private void removePieces3()
        {
                ArrayList<Icon> whitePiecesIcons = whiteTestSet3();
                ArrayList<Icon> blackPiecesIcons = blackTestSet3();
                removePiecesDifferent(whitePlayer, whitePiecesIcons);
                removePiecesDifferent(blackPlayer, blackPiecesIcons);
                removePiece(whitePlayer.pieces[11]);
        }

        private void setPositions3()
        {
                movePiece(bishop, 4, 3);
                movePiece(whitePlayer.pieces[15], 5, 2);
                movePiece(blackPlayer.pieces[15], 1, 6);
        }

        private ArrayList<Icon> whiteTestSet3()
        {
                ArrayList<Icon> icons = new ArrayList<>();
                icons.add(Icon.B);
                icons.add(Icon.K);
                return icons;
        }

        private ArrayList<Icon> blackTestSet3()
        {
                ArrayList<Icon> icons = new ArrayList<>();
                icons.add(Icon.K);
                return icons;
        }

        private boolean moveTestShouldReturnTrue3()
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
