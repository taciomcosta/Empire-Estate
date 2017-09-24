package tests;

import org.junit.Test;
import pieces.Icon;

import java.util.ArrayList;

import static junit.framework.Assert.assertTrue;

public class StalemateTest extends tests.Test
{
        @Test
        public void testIsStalemate()
        {
                setUp1();
//                board.print();
                assertTrue(blackPlayer.isStalemate());
                setUp2();
//                board.print();
                assertTrue(blackPlayer.isStalemate());
                setUp3();
//                board.print();
                assertTrue(blackPlayer.isStalemate());
                setUp4();
//                board.print();
                assertTrue(blackPlayer.isStalemate());
                setUp5();
//                board.print();
                assertTrue(blackPlayer.isStalemate());
                setUp6();
//                board.print();
                assertTrue(blackPlayer.isStalemate());
        }

        private void setUp1()
        {
                resetElements();
                removePieces1();
                setPositions1();
        }

        private void setUp2()
        {
                resetElements();
                removePieces2();
                setPositions2();
        }

        private void setUp3()
        {
                resetElements();
                removePieces3();
                setPositions3();
        }

        private void setUp4()
        {
                resetElements();
                removePieces4();
                setPositions4();
        }

        private void setUp5()
        {
                resetElements();
                removePieces5();
                setPositions5();
        }

        private void setUp6()
        {
                resetElements();
                removePieces6();
                setPositions6();
        }

        private void removePieces1()
        {
                ArrayList<Icon> whitePiecesIcons = whiteTestSet1();
                ArrayList<Icon> blackPiecesIcons = blackTestSet1();
                removePiecesDifferent(whitePlayer, whitePiecesIcons);
                removePiecesDifferent(blackPlayer, blackPiecesIcons);
        }

        private void setPositions1()
        {
                movePiece(whitePlayer.pieces[15], 1,5);
                movePiece(whitePlayer.pieces[14], 2, 6);
                movePiece(blackPlayer.pieces[15], 0, 7);
        }

        private void removePieces2()
        {
                ArrayList<Icon> whitePiecesIcons = whiteTestSet2();
                ArrayList<Icon> blackPiecesIcons = blackTestSet2();
                removePiecesDifferent(whitePlayer, whitePiecesIcons);
                removePiecesDifferent(blackPlayer, blackPiecesIcons);
        }

        private void setPositions2()
        {
                movePiece(whitePlayer.pieces[0], 1,5);
                movePiece(whitePlayer.pieces[15], 2, 5);
                movePiece(blackPlayer.pieces[15], 0, 5);
        }

        private void removePieces3()
        {
                ArrayList<Icon> whitePiecesIcons = whiteTestSet3();
                ArrayList<Icon> blackPiecesIcons = blackTestSet3();
                removePiecesDifferent(whitePlayer, whitePiecesIcons);
                removePiecesDifferent(blackPlayer, blackPiecesIcons);
                removePiece(whitePlayer.pieces[9]);
                removePiece(blackPlayer.pieces[11]);
        }

        private void setPositions3()
        {
                movePiece(whitePlayer.pieces[8], 0,7);
                movePiece(whitePlayer.pieces[15], 2,1);
                movePiece(blackPlayer.pieces[10], 0, 1);
                movePiece(blackPlayer.pieces[15], 0,0);
        }

        private void removePieces4()
        {
                ArrayList<Icon> whitePiecesIcons = whiteTestSet4();
                ArrayList<Icon> blackPiecesIcons = blackTestSet4();
                removePiecesDifferent(whitePlayer, whitePiecesIcons);
                removePiecesDifferent(blackPlayer, blackPiecesIcons);
                removePiece(whitePlayer.pieces[9]);
        }

        private void setPositions4()
        {
                movePiece(whitePlayer.pieces[8], 6,1);
                movePiece(whitePlayer.pieces[15], 5,2);
                movePiece(blackPlayer.pieces[15], 7,0);
        }

        private void removePieces5()
        {
                ArrayList<Icon> whitePiecesIcons = whiteTestSet5();
                ArrayList<Icon> blackPiecesIcons = blackTestSet5();
                removePiecesDifferent(whitePlayer, whitePiecesIcons);
                removePiecesDifferent(blackPlayer, blackPiecesIcons);
                for (int i = 1; i < 8; ++i)
                        removePiece(blackPlayer.pieces[i]);
        }

        private void setPositions5()
        {
                movePiece(whitePlayer.pieces[14], 5,1);
                movePiece(whitePlayer.pieces[15], 3,6);
                movePiece(blackPlayer.pieces[0], 6,0);
                movePiece(blackPlayer.pieces[15], 7,0);
        }

        private void removePieces6()
        {
                ArrayList<Icon> whitePiecesIcons = whiteTestSet6();
                ArrayList<Icon> blackPiecesIcons = blackTestSet6();
                removePiecesDifferent(whitePlayer, whitePiecesIcons);
                removePiecesDifferent(blackPlayer, blackPiecesIcons);
                for (int i = 1; i < 8; ++i)
                        removePiece(whitePlayer.pieces[i]);
        }

        private void setPositions6()
        {
                movePiece(whitePlayer.pieces[0], 1,0);
                movePiece(whitePlayer.pieces[10], 4,5);
                movePiece(whitePlayer.pieces[15], 2,0);
                movePiece(blackPlayer.pieces[15], 0,0);
        }

        private ArrayList<Icon> whiteTestSet1()
        {
                ArrayList<Icon> icons = new ArrayList<>();
                icons.add(Icon.Q);
                icons.add(Icon.K);
                return icons;
        }

        private ArrayList<Icon> blackTestSet1()
        {
                ArrayList<Icon> icons = new ArrayList<>();
                icons.add(Icon.K);
                return icons;
        }

        private ArrayList<Icon> whiteTestSet2()
        {
                ArrayList<Icon> icons = new ArrayList<>();
                icons.add(Icon.P);
                icons.add(Icon.K);
                return icons;
        }

        private ArrayList<Icon> blackTestSet2()
        {
                ArrayList<Icon> icons = new ArrayList<>();
                icons.add(Icon.K);
                return icons;
        }

        private ArrayList<Icon> whiteTestSet3()
        {
                ArrayList<Icon> icons = new ArrayList<>();
                icons.add(Icon.R);
                icons.add(Icon.K);
                return icons;
        }

        private ArrayList<Icon> blackTestSet3()
        {
                ArrayList<Icon> icons = new ArrayList<>();
                icons.add(Icon.B);
                icons.add(Icon.K);
                return icons;
        }

        private ArrayList<Icon> whiteTestSet4()
        {
                ArrayList<Icon> icons = new ArrayList<>();
                icons.add(Icon.R);
                icons.add(Icon.K);
                return icons;
        }

        private ArrayList<Icon> blackTestSet4()
        {
                ArrayList<Icon> icons = new ArrayList<>();
                icons.add(Icon.K);
                return icons;
        }

        private ArrayList<Icon> whiteTestSet5()
        {
                ArrayList<Icon> icons = new ArrayList<>();
                icons.add(Icon.Q);
                icons.add(Icon.K);
                return icons;
        }

        private ArrayList<Icon> blackTestSet5()
        {
                ArrayList<Icon> icons = new ArrayList<>();
                icons.add(Icon.P);
                icons.add(Icon.K);
                return icons;
        }

        private ArrayList<Icon> whiteTestSet6()
        {
                ArrayList<Icon> icons = new ArrayList<>();
                icons.add(Icon.P);
                icons.add(Icon.B);
                icons.add(Icon.K);
                removePiece(whitePlayer.pieces[11]);
                return icons;
        }

        private ArrayList<Icon> blackTestSet6()
        {
                ArrayList<Icon> icons = new ArrayList<>();
                icons.add(Icon.K);
                return icons;
        }
}