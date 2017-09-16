package tests;

import chessboard.Chessboard;
import chessgame.ChessGame;
import org.junit.Before;
import org.junit.Test;
import pieces.piece.Piece;
import player.Player;

import java.util.ArrayList;

import static junit.framework.Assert.assertTrue;

public class StalemateTest
{
        private ChessGame game = new ChessGame();
        private Player whitePlayer = game.model.player1;
        private Player blackPlayer = game.model.player2;
        private Chessboard board = game.model.board;

        /*
        * Run one testCase per time, because only one game was created :)
        * */
        @Before
        public void setUp()
        {
//                setUp1();
//                setUp2();
//                setUp3();
//                setUp4();
//                setUp5();
//                setUp6();
                board.printModel();
        }

        @Test
        public void testIsStalemate()
        {
                assertTrue(blackPlayer.is_stalemate());
        }

        public void setUp1()
        {
                removePieces1();
                setPositions1();
        }

        public void setUp2()
        {
                removePieces2();
                setPositions2();
        }

        public void setUp3()
        {
                removePieces3();
                setPositions3();
        }

        public void setUp4()
        {
                removePieces4();
                setPositions4();
        }

        public void setUp5()
        {
                removePieces5();
                setPositions5();
        }

        public void setUp6()
        {
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

        public void removePiecesDifferent(Player player,
                                          ArrayList<Piece.Icon> piecesIcon)
        {
                for (Piece playerPiece : player.getPieces())
                        if (!piecesIcon.contains(playerPiece.getPieceInitial()))
                                removePiece(playerPiece);
        }

        public void removePiece(Piece piece)
        {
                board.removePiece(piece.getRow(), piece.getCol());
                piece.setCaptured(true);
                piece.unsetPositionFromBoardRange();
        }

        public void movePiece(Piece piece, int finalRow, int finalCol)
        {
                board.removePiece(piece.getRow(), piece.getCol());
                board.addPiece(piece, finalRow, finalCol);
                piece.setRow(finalRow);
                piece.setCol(finalCol);
                piece.increaseMoves();
        }
}
