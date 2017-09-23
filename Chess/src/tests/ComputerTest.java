package tests;

import org.junit.Test;
import pieces.piece.Piece;
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
//                board.printModel();
                setUp2();
                assertEquals(Integer.MIN_VALUE, computer.evaluateBoard());
//                board.printModel();
        }

        @Test
        public void testGetMostValuablePiece()
        {
                setUp1();
                assertEquals(
                        blackPlayer.pieces[14],
                        computer.getMostValuablePiece(computer.getCapturedPieces())
                );
//                board.printModel();
                setUp2();
                assertEquals(
                        blackPlayer.pieces[15],
                        computer.getMostValuablePiece(computer.getCapturedPieces())
                );
//                board.printModel();
        }

        @Test
        public void testGetBestMove()
        {
                computer.depth = 4;
                setUp3();
//                board.printModel();
                assertTrue(isBestMoveShouldReturnTrue(3, 3));
                setUp4();
//                board.printModel();
                assertTrue(isBestMoveShouldReturnTrue(5, 5));
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
                movePiece(whitePlayer.pieces[0], 4,4);
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
                icons.add(Piece.Icon.K);
                return icons;
        }

        public ArrayList<Piece.Icon> blackTestSet1()
        {
                ArrayList<Piece.Icon> icons = new ArrayList<>();
                icons.add(Piece.Icon.K);
                icons.add(Piece.Icon.R);
                return icons;
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
                for (int i = 1; i < 8; ++i)
                        removePiece(whitePlayer.pieces[i]);
        }

        public void setPositions2()
        {
                movePiece(whitePlayer.pieces[0], 4,4);
                movePiece(whitePlayer.pieces[14], 3, 5);
                movePiece(whitePlayer.pieces[15], 3, 3);
                movePiece(blackPlayer.pieces[8], 5, 3);
                movePiece(blackPlayer.pieces[9], 4, 5);
        }

        public ArrayList<Piece.Icon> whiteTestSet2()
        {
                ArrayList<Piece.Icon> icons = new ArrayList<>();
                icons.add(Piece.Icon.P);
                icons.add(Piece.Icon.K);
                icons.add(Piece.Icon.Q);
                return icons;
        }

        public ArrayList<Piece.Icon> blackTestSet2()
        {
                ArrayList<Piece.Icon> icons = new ArrayList<>();
                icons.add(Piece.Icon.R);
                return icons;
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
                for (int i = 1; i < 8; ++i)
                        removePiece(blackPlayer.pieces[i]);
        }

        public void setPositions3()
        {
                movePiece(blackPlayer.pieces[0], 4,4);
                movePiece(whitePlayer.pieces[14], 3, 5);
                movePiece(whitePlayer.pieces[15], 3, 3);
                movePiece(blackPlayer.pieces[8], 5, 3);
                movePiece(blackPlayer.pieces[9], 4, 5);
        }

        public ArrayList<Piece.Icon> whiteTestSet3()
        {
                ArrayList<Piece.Icon> icons = new ArrayList<>();
                icons.add(Piece.Icon.Q);
                icons.add(Piece.Icon.K);
                return icons;
        }

        public ArrayList<Piece.Icon> blackTestSet3()
        {
                ArrayList<Piece.Icon> icons = new ArrayList<>();
                icons.add(Piece.Icon.K);
                icons.add(Piece.Icon.P);
                icons.add(Piece.Icon.R);
                return icons;
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
                        removePiece(blackPlayer.pieces[i]);
        }

        public void setPositions4()
        {
                movePiece(blackPlayer.pieces[0], 4,4);
                movePiece(whitePlayer.pieces[14], 5, 5);
                movePiece(blackPlayer.pieces[8], 5, 3);
                movePiece(blackPlayer.pieces[9], 4, 5);
        }

        public ArrayList<Piece.Icon> whiteTestSet4()
        {
                ArrayList<Piece.Icon> icons = new ArrayList<>();
                icons.add(Piece.Icon.Q);
                icons.add(Piece.Icon.K);
                return icons;
        }

        public ArrayList<Piece.Icon> blackTestSet4()
        {
                ArrayList<Piece.Icon> icons = new ArrayList<>();
                icons.add(Piece.Icon.K);
                icons.add(Piece.Icon.P);
                icons.add(Piece.Icon.R);
                return icons;
        }

        public boolean isBestMoveShouldReturnTrue(int bestRow, int bestCol)
        {
                Move bestMove = computer.getBestMove(computer.depth);
                if (bestMove.getFinalRow() == bestRow &&
                        bestMove.getFinalCol() == bestCol)
                        return true;
                return false;
        }

        public void resetElements()
        {
                super.resetElements();
                computer = (Computer) blackPlayer;
        }
}
