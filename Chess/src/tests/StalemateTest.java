package tests;

import org.junit.Test;
import pieces.piece.Piece;

import java.util.ArrayList;

import static junit.framework.Assert.assertTrue;

public class StalemateTest extends tests.Test
{
        @Test
        public void testIsStalemate()
        {
                setUp1();
                board.printModel();
                assertTrue(blackPlayer.isStalemate());
                setUp2();
                board.printModel();
                assertTrue(blackPlayer.isStalemate());
                setUp3();
                board.printModel();
                assertTrue(blackPlayer.isStalemate());
                setUp4();
                board.printModel();
                assertTrue(blackPlayer.isStalemate());
                setUp5();
                board.printModel();
                assertTrue(blackPlayer.isStalemate());
                setUp6();
                board.printModel();
                assertTrue(blackPlayer.isStalemate());
        }

        public void setUp1()
        {
                resetElements();
                removePieces1();
                setPositions1();
        }

        public void setUp2()
        {
                resetElements();
                removePieces2();
                setPositions2();
        }

        public void setUp3()
        {
                resetElements();
                removePieces3();
                setPositions3();
        }

        public void setUp4()
        {
                resetElements();
                removePieces4();
                setPositions4();
        }

        public void setUp5()
        {
                resetElements();
                removePieces5();
                setPositions5();
        }

        public void setUp6()
        {
                resetElements();
                removePieces6();
                setPositions6();
        }

        public void removePieces1()
        {
                ArrayList<Piece.Icon> whitePiecesIcon = whiteTestSet1();
                ArrayList<Piece.Icon> blackPiecesIcon = blackTestSet1();
                removePiecesDifferent(whitePlayer, whitePiecesIcon);
                removePiecesDifferent(blackPlayer, blackPiecesIcon);
        }

        public void setPositions1()
        {
                movePiece(whitePlayer.pieces[15], 1,5);
                movePiece(whitePlayer.pieces[14], 2, 6);
                movePiece(blackPlayer.pieces[15], 0, 7);
        }

        public void removePieces2()
        {
                ArrayList<Piece.Icon> whitePiecesIcon = whiteTestSet2();
                ArrayList<Piece.Icon> blackPiecesIcon = blackTestSet2();
                removePiecesDifferent(whitePlayer, whitePiecesIcon);
                removePiecesDifferent(blackPlayer, blackPiecesIcon);
        }

        public void setPositions2()
        {
                movePiece(whitePlayer.pieces[0], 1,5);
                movePiece(whitePlayer.pieces[15], 2, 5);
                movePiece(blackPlayer.pieces[15], 0, 5);
        }

        public void removePieces3()
        {
                ArrayList<Piece.Icon> whitePiecesIcon = whiteTestSet3();
                ArrayList<Piece.Icon> blackPiecesIcon = blackTestSet3();
                removePiecesDifferent(whitePlayer, whitePiecesIcon);
                removePiecesDifferent(blackPlayer, blackPiecesIcon);
                removePiece(whitePlayer.pieces[9]);
                removePiece(blackPlayer.pieces[11]);
        }

        public void setPositions3()
        {
                movePiece(whitePlayer.pieces[8], 0,7);
                movePiece(whitePlayer.pieces[15], 2,1);
                movePiece(blackPlayer.pieces[10], 0, 1);
                movePiece(blackPlayer.pieces[15], 0,0);
        }

        public void removePieces4()
        {
                ArrayList<Piece.Icon> whitePiecesIcon = whiteTestSet4();
                ArrayList<Piece.Icon> blackPiecesIcon = blackTestSet4();
                removePiecesDifferent(whitePlayer, whitePiecesIcon);
                removePiecesDifferent(blackPlayer, blackPiecesIcon);
                removePiece(whitePlayer.pieces[9]);
        }

        public void setPositions4()
        {
                movePiece(whitePlayer.pieces[8], 6,1);
                movePiece(whitePlayer.pieces[15], 5,2);
                movePiece(blackPlayer.pieces[15], 7,0);
        }

        public void removePieces5()
        {
                ArrayList<Piece.Icon> whitePiecesIcon = whiteTestSet5();
                ArrayList<Piece.Icon> blackPiecesIcon = blackTestSet5();
                removePiecesDifferent(whitePlayer, whitePiecesIcon);
                removePiecesDifferent(blackPlayer, blackPiecesIcon);
                for (int i = 1; i < 8; ++i)
                        removePiece(blackPlayer.pieces[i]);
        }

        public void setPositions5()
        {
                movePiece(whitePlayer.pieces[14], 5,1);
                movePiece(whitePlayer.pieces[15], 3,6);
                movePiece(blackPlayer.pieces[0], 6,0);
                movePiece(blackPlayer.pieces[15], 7,0);
        }

        public void removePieces6()
        {
                ArrayList<Piece.Icon> whitePiecesIcon = whiteTestSet6();
                ArrayList<Piece.Icon> blackPiecesIcon = blackTestSet6();
                removePiecesDifferent(whitePlayer, whitePiecesIcon);
                removePiecesDifferent(blackPlayer, blackPiecesIcon);
                for (int i = 1; i < 8; ++i)
                        removePiece(whitePlayer.pieces[i]);
        }

        public void setPositions6()
        {
                movePiece(whitePlayer.pieces[0], 1,0);
                movePiece(whitePlayer.pieces[10], 4,5);
                movePiece(whitePlayer.pieces[15], 2,0);
                movePiece(blackPlayer.pieces[15], 0,0);
        }

        public ArrayList<Piece.Icon> whiteTestSet1()
        {
                ArrayList<Piece.Icon> icons = new ArrayList<>();
                icons.add(Piece.Icon.Q);
                icons.add(Piece.Icon.K);
                return icons;
        }

        public ArrayList<Piece.Icon> blackTestSet1()
        {
                ArrayList<Piece.Icon> icons = new ArrayList<>();
                icons.add(Piece.Icon.K);
                return icons;
        }

        public ArrayList<Piece.Icon> whiteTestSet2()
        {
                ArrayList<Piece.Icon> icons = new ArrayList<>();
                icons.add(Piece.Icon.P);
                icons.add(Piece.Icon.K);
                return icons;
        }

        public ArrayList<Piece.Icon> blackTestSet2()
        {
                ArrayList<Piece.Icon> icons = new ArrayList<>();
                icons.add(Piece.Icon.K);
                return icons;
        }

        public ArrayList<Piece.Icon> whiteTestSet3()
        {
                ArrayList<Piece.Icon> icons = new ArrayList<>();
                icons.add(Piece.Icon.R);
                icons.add(Piece.Icon.K);
                return icons;
        }

        public ArrayList<Piece.Icon> blackTestSet3()
        {
                ArrayList<Piece.Icon> icons = new ArrayList<>();
                icons.add(Piece.Icon.B);
                icons.add(Piece.Icon.K);
                return icons;
        }

        public ArrayList<Piece.Icon> whiteTestSet4()
        {
                ArrayList<Piece.Icon> icons = new ArrayList<>();
                icons.add(Piece.Icon.R);
                icons.add(Piece.Icon.K);
                return icons;
        }

        public ArrayList<Piece.Icon> blackTestSet4()
        {
                ArrayList<Piece.Icon> icons = new ArrayList<>();
                icons.add(Piece.Icon.K);
                return icons;
        }

        public ArrayList<Piece.Icon> whiteTestSet5()
        {
                ArrayList<Piece.Icon> icons = new ArrayList<>();
                icons.add(Piece.Icon.Q);
                icons.add(Piece.Icon.K);
                return icons;
        }

        public ArrayList<Piece.Icon> blackTestSet5()
        {
                ArrayList<Piece.Icon> icons = new ArrayList<>();
                icons.add(Piece.Icon.P);
                icons.add(Piece.Icon.K);
                return icons;
        }

        public ArrayList<Piece.Icon> whiteTestSet6()
        {
                ArrayList<Piece.Icon> icons = new ArrayList<>();
                icons.add(Piece.Icon.P);
                icons.add(Piece.Icon.B);
                icons.add(Piece.Icon.K);
                removePiece(whitePlayer.pieces[11]);
                return icons;
        }

        public ArrayList<Piece.Icon> blackTestSet6()
        {
                ArrayList<Piece.Icon> icons = new ArrayList<>();
                icons.add(Piece.Icon.K);
                return icons;
        }
}