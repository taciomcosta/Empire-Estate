package tests;

import org.junit.Test;
import pieces.Icon;
import java.util.ArrayList;
import static org.junit.Assert.assertTrue;

public class CheckmateTest extends tests.Test
{
        @Test
        public void testIsCheckmate()
        {
                setUp1();
//                board.print();
                assertTrue(whitePlayer.kingIsCheckmated(blackPlayer));
                setUp2();
//                board.print();
                assertTrue(whitePlayer.kingIsCheckmated(blackPlayer));
                setUp3();
//                board.print();
                assertTrue(whitePlayer.kingIsCheckmated(blackPlayer));
                setUp4();
//                board.print();
                assertTrue(whitePlayer.kingIsCheckmated(blackPlayer));
                setUp5();
//                board.print();
                assertTrue(whitePlayer.kingIsCheckmated(blackPlayer));
                setUp6();
//                board.print();
                assertTrue(whitePlayer.kingIsCheckmated(blackPlayer));
        }

        private void setUp1()
        {
                resetElements();
                setPositions1();
        }

        private void setPositions1()
        {
                movePiece(blackPlayer.pieces[14], 4, 7);
                movePiece(whitePlayer.pieces[5], 5, 5);
                movePiece(whitePlayer.pieces[6], 4, 6);

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
        }

        private void setPositions2()
        {
                movePiece(whitePlayer.pieces[15], 7, 2);
                movePiece(blackPlayer.pieces[8], 6, 2);
                movePiece(blackPlayer.pieces[10], 5, 1);
                movePiece(blackPlayer.pieces[12], 5, 2);
                movePiece(blackPlayer.pieces[15], 1, 6);
        }

        private ArrayList<Icon> whiteTestSet2()
        {
                ArrayList<Icon> icons = new ArrayList<>();
                icons.add(Icon.K);
                return icons;
        }

        private ArrayList<Icon> blackTestSet2()
        {
                ArrayList<Icon> icons = new ArrayList<>();
                icons.add(Icon.K);
                icons.add(Icon.B);
                icons.add(Icon.N);
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
                removePiece(blackPlayer.pieces[9]);
        }

        private void setPositions3()
        {
                movePiece(whitePlayer.pieces[15], 5,7);
                movePiece(blackPlayer.pieces[8], 7,7);
                movePiece(blackPlayer.pieces[15], 5,5);
        }

        private ArrayList<Icon> whiteTestSet3()
        {
                ArrayList<Icon> icons = new ArrayList<>();
                icons.add(Icon.K);
                return icons;
        }

        private ArrayList<Icon> blackTestSet3()
        {
                ArrayList<Icon> icons = new ArrayList<>();
                icons.add(Icon.R);
                icons.add(Icon.K);
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
        }

        private void setPositions4()
        {
                movePiece(whitePlayer.pieces[15], 2,0);
                movePiece(blackPlayer.pieces[14], 2,1);
                movePiece(blackPlayer.pieces[15], 2,2);
        }

        private ArrayList<Icon> whiteTestSet4()
        {
                ArrayList<Icon> icons = new ArrayList<>();
                icons.add(Icon.K);
                return icons;
        }

        private ArrayList<Icon> blackTestSet4()
        {
                ArrayList<Icon> icons = new ArrayList<>();
                icons.add(Icon.Q);
                icons.add(Icon.K);
                return icons;
        }

        private void setUp5()
        {
                resetElements();
                removePieces5();
                setPositions5();
        }

        private void removePieces5()
        {
                ArrayList<Icon> whitePiecesIcons = whiteTestSet5();
                ArrayList<Icon> blackPiecesIcons = blackTestSet5();
                removePiecesDifferent(whitePlayer, whitePiecesIcons);
                removePiecesDifferent(blackPlayer, blackPiecesIcons);
                removePiece(blackPlayer.pieces[11]);
                removePiece(blackPlayer.pieces[12]);
        }

        private void setPositions5()
        {
                movePiece(whitePlayer.pieces[15], 0,6);
                movePiece(blackPlayer.pieces[10], 1,6);
                movePiece(blackPlayer.pieces[13], 2,5);
                movePiece(blackPlayer.pieces[15], 2,6);
        }

        private ArrayList<Icon> whiteTestSet5()
        {
                ArrayList<Icon> icons = new ArrayList<>();
                icons.add(Icon.K);
                return icons;
        }

        private ArrayList<Icon> blackTestSet5()
        {
                ArrayList<Icon> icons = new ArrayList<>();
                icons.add(Icon.N);
                icons.add(Icon.B);
                icons.add(Icon.K);
                return icons;
        }

        private void setUp6()
        {
                resetElements();
                removePieces6();
                setPositions6();
        }

        private void removePieces6()
        {
                ArrayList<Icon> whitePiecesIcons = whiteTestSet6();
                ArrayList<Icon> blackPiecesIcons = blackTestSet6();
                removePiecesDifferent(whitePlayer, whitePiecesIcons);
                removePiecesDifferent(blackPlayer, blackPiecesIcons);
                removePiece(blackPlayer.pieces[11]);
                removePiece(blackPlayer.pieces[12]);
        }

        private void setPositions6()
        {
                movePiece(whitePlayer.pieces[15], 0,7);
                movePiece(blackPlayer.pieces[10], 2,5);
                movePiece(blackPlayer.pieces[13], 2,7);
                movePiece(blackPlayer.pieces[15], 2,6);
        }

        private ArrayList<Icon> whiteTestSet6()
        {
                ArrayList<Icon> icons = new ArrayList<>();
                icons.add(Icon.K);
                return icons;
        }

        private ArrayList<Icon> blackTestSet6()
        {
                ArrayList<Icon> icons = new ArrayList<>();
                icons.add(Icon.N);
                icons.add(Icon.B);
                icons.add(Icon.K);
                return icons;
        }
}
