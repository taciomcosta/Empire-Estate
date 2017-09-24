package tests;

import org.junit.Test;
import pieces.Icon;
import player.Computer;
import player.Move;

import java.util.ArrayList;
import static junit.framework.Assert.assertEquals;
import static junit.framework.Assert.assertTrue;

public class ComputerTest extends tests.Test
{
        private Computer computer;

        @Test
        public void testEvaluateBoard()
        {
                setUp1();
                assertEquals(0, computer.evaluateBoard());
//                board.print();
                setUp2();
                assertEquals(Integer.MIN_VALUE, computer.evaluateBoard());
//                board.print();
        }

        @Test
        public void testGetMostValuablePiece()
        {
                setUp1();
                assertEquals(
                        blackPlayer.pieces[14],
                        computer.getMostValuablePiece(computer.getCapturedPieces())
                );
//                board.print();
                setUp2();
                assertEquals(
                        blackPlayer.pieces[15],
                        computer.getMostValuablePiece(computer.getCapturedPieces())
                );
//                board.print();
        }

        @Test
        public void testGetBestMove()
        {
                setUp3();
//                board.print();
                assertTrue(isBestMoveShouldReturnTrue(3, 3));
                setUp4();
//                board.print();
                assertTrue(isBestMoveShouldReturnTrue(5, 5));
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
                movePiece(whitePlayer.pieces[0], 4,4);
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
                icons.add(Icon.K);
                return icons;
        }

        private ArrayList<Icon> blackTestSet1()
        {
                ArrayList<Icon> icons = new ArrayList<>();
                icons.add(Icon.K);
                icons.add(Icon.R);
                return icons;
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
                for (int i = 1; i < 8; ++i)
                        removePiece(whitePlayer.pieces[i]);
        }

        private void setPositions2()
        {
                movePiece(whitePlayer.pieces[0], 4,4);
                movePiece(whitePlayer.pieces[14], 3, 5);
                movePiece(whitePlayer.pieces[15], 3, 3);
                movePiece(blackPlayer.pieces[8], 5, 3);
                movePiece(blackPlayer.pieces[9], 4, 5);
        }

        private ArrayList<Icon> whiteTestSet2()
        {
                ArrayList<Icon> icons = new ArrayList<>();
                icons.add(Icon.P);
                icons.add(Icon.K);
                icons.add(Icon.Q);
                return icons;
        }

        private ArrayList<Icon> blackTestSet2()
        {
                ArrayList<Icon> icons = new ArrayList<>();
                icons.add(Icon.R);
                return icons;
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
                for (int i = 1; i < 8; ++i)
                        removePiece(blackPlayer.pieces[i]);
        }

        private void setPositions3()
        {
                movePiece(blackPlayer.pieces[0], 4,4);
                movePiece(whitePlayer.pieces[14], 3, 5);
                movePiece(whitePlayer.pieces[15], 3, 3);
                movePiece(blackPlayer.pieces[8], 5, 3);
                movePiece(blackPlayer.pieces[9], 4, 5);
        }

        private ArrayList<Icon> whiteTestSet3()
        {
                ArrayList<Icon> icons = new ArrayList<>();
                icons.add(Icon.Q);
                icons.add(Icon.K);
                return icons;
        }

        private ArrayList<Icon> blackTestSet3()
        {
                ArrayList<Icon> icons = new ArrayList<>();
                icons.add(Icon.K);
                icons.add(Icon.P);
                icons.add(Icon.R);
                return icons;
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
                        removePiece(blackPlayer.pieces[i]);
        }

        private void setPositions4()
        {
                movePiece(blackPlayer.pieces[0], 4,4);
                movePiece(whitePlayer.pieces[14], 5, 5);
                movePiece(blackPlayer.pieces[8], 5, 3);
                movePiece(blackPlayer.pieces[9], 4, 5);
        }

        private ArrayList<Icon> whiteTestSet4()
        {
                ArrayList<Icon> icons = new ArrayList<>();
                icons.add(Icon.Q);
                icons.add(Icon.K);
                return icons;
        }

        private ArrayList<Icon> blackTestSet4()
        {
                ArrayList<Icon> icons = new ArrayList<>();
                icons.add(Icon.K);
                icons.add(Icon.P);
                icons.add(Icon.R);
                return icons;
        }

        private boolean isBestMoveShouldReturnTrue(int bestRow, int bestCol)
        {
                Move bestMove = computer.getBestMove(Computer.DEPTH);
                return bestMove.getFinalRow() == bestRow &&
                        bestMove.getFinalCol() == bestCol;
        }

        public void resetElements()
        {
                super.resetElements();
                computer = (Computer) blackPlayer;
        }
}
