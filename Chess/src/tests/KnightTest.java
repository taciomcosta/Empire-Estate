package tests;

import chessboard.Utils;
import org.junit.Test;
import pieces.Icon;
import pieces.Knight;

import java.util.ArrayList;

import static junit.framework.Assert.assertTrue;

public class KnightTest extends tests.Test
{
        private Knight knight;

        @Test
        public void testCanCaptureAndCanMove()
        {
                setUp1();
//                board.print();
                assertTrue(captureTestShouldReturnTrue1());
                setUp3();
//                board.print();
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
                removePiece(whitePlayer.pieces[13]);
        }

        private void setPositions1()
        {
                movePiece(knight, 4,3);
                movePiece(whitePlayer.pieces[15], 6, 4);
                movePiece(blackPlayer.pieces[10], 2, 4);
                movePiece(blackPlayer.pieces[11], 3, 3);
        }

        private ArrayList<Icon> whiteTestSet1()
        {
                ArrayList<Icon> icons = new ArrayList<>();
                icons.add(Icon.N);
                icons.add(Icon.K);
                return icons;
        }

        private ArrayList<Icon> blackTestSet1()
        {
                ArrayList<Icon> icons = new ArrayList<>();
                icons.add(Icon.B);
                return icons;
        }

        private boolean captureTestShouldReturnTrue1()
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
                removePiece(whitePlayer.pieces[13]);
        }

        private void setPositions3()
        {
                movePiece(knight, 4, 3);
                movePiece(blackPlayer.pieces[15], 2, 4);
                movePiece(whitePlayer.pieces[15], 6, 4);
        }

        private ArrayList<Icon> whiteTestSet3()
        {
                ArrayList<Icon> icons = new ArrayList<>();
                icons.add(Icon.N);
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
