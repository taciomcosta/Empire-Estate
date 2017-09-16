package tests;

import chessboard.Chessboard;
import chessgame.ChessGame;
import org.junit.Before;
import org.junit.Test;
import pieces.piece.Piece;
import player.Player;

import java.util.ArrayList;

import static org.junit.Assert.assertTrue;

public class CheckmateTest
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
        public void testIsCheckmate()
        {
                assertTrue(whitePlayer.king_is_checkmated(blackPlayer));
        }

        public void setUp1()
        {
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

        public void setPositions1()
        {
                movePiece(blackPlayer.pieces[14], 4, 7);
                movePiece(whitePlayer.pieces[5], 5, 5);
                movePiece(whitePlayer.pieces[6], 4, 6);

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
                movePiece(whitePlayer.pieces[15], 7, 2);
                movePiece(blackPlayer.pieces[8], 6, 2);
                movePiece(blackPlayer.pieces[10], 5, 1);
                movePiece(blackPlayer.pieces[12], 5, 2);
                movePiece(blackPlayer.pieces[15], 1, 6);
        }

        public void removePieces3()
        {
                ArrayList<Piece.Icon> whitePiecesIcon = whiteTestSet3();
                ArrayList<Piece.Icon> blackPiecesIcon = blackTestSet3();
                removePiecesDifferent(whitePlayer, whitePiecesIcon);
                removePiecesDifferent(blackPlayer, blackPiecesIcon);
                removePiece(blackPlayer.pieces[9]);
        }

        public void setPositions3()
        {
                movePiece(whitePlayer.pieces[15], 5,7);
                movePiece(blackPlayer.pieces[8], 7,7);
                movePiece(blackPlayer.pieces[15], 5,5);
        }

        public void removePieces4()
        {
                ArrayList<Piece.Icon> whitePiecesIcon = whiteTestSet4();
                ArrayList<Piece.Icon> blackPiecesIcon = blackTestSet4();
                removePiecesDifferent(whitePlayer, whitePiecesIcon);
                removePiecesDifferent(blackPlayer, blackPiecesIcon);
        }

        public void setPositions4()
        {
                movePiece(whitePlayer.pieces[15], 2,0);
                movePiece(blackPlayer.pieces[14], 2,1);
                movePiece(blackPlayer.pieces[15], 2,2);
        }

        public void removePieces5()
        {
                ArrayList<Piece.Icon> whitePiecesIcon = whiteTestSet5();
                ArrayList<Piece.Icon> blackPiecesIcon = blackTestSet5();
                removePiecesDifferent(whitePlayer, whitePiecesIcon);
                removePiecesDifferent(blackPlayer, blackPiecesIcon);
                removePiece(blackPlayer.pieces[11]);
                removePiece(blackPlayer.pieces[12]);
        }

        public void setPositions5()
        {
                movePiece(whitePlayer.pieces[15], 0,6);
                movePiece(blackPlayer.pieces[10], 1,6);
                movePiece(blackPlayer.pieces[13], 2,5);
                movePiece(blackPlayer.pieces[15], 2,6);
        }

        public void removePieces6()
        {
                ArrayList<Piece.Icon> whitePiecesIcon = whiteTestSet6();
                ArrayList<Piece.Icon> blackPiecesIcon = blackTestSet6();
                removePiecesDifferent(whitePlayer, whitePiecesIcon);
                removePiecesDifferent(blackPlayer, blackPiecesIcon);
                removePiece(blackPlayer.pieces[11]);
                removePiece(blackPlayer.pieces[12]);
        }

        public void setPositions6()
        {
                movePiece(whitePlayer.pieces[15], 0,7);
                movePiece(blackPlayer.pieces[10], 2,5);
                movePiece(blackPlayer.pieces[13], 2,7);
                movePiece(blackPlayer.pieces[15], 2,6);
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
                icons.add(Piece.Icon.K);
                return icons;
        }

        public ArrayList<Piece.Icon> blackTestSet2()
        {
                ArrayList<Piece.Icon> icons = new ArrayList<>();
                icons.add(Piece.Icon.K);
                icons.add(Piece.Icon.B);
                icons.add(Piece.Icon.N);
                icons.add(Piece.Icon.R);
                return icons;
        }

        public ArrayList<Piece.Icon> whiteTestSet3()
        {
                ArrayList<Piece.Icon> icons = new ArrayList<>();
                icons.add(Piece.Icon.K);
                return icons;
        }

        public ArrayList<Piece.Icon> blackTestSet3()
        {
                ArrayList<Piece.Icon> icons = new ArrayList<>();
                icons.add(Piece.Icon.R);
                icons.add(Piece.Icon.K);
                return icons;
        }

        public ArrayList<Piece.Icon> whiteTestSet4()
        {
                ArrayList<Piece.Icon> icons = new ArrayList<>();
                icons.add(Piece.Icon.K);
                return icons;
        }

        public ArrayList<Piece.Icon> blackTestSet4()
        {
                ArrayList<Piece.Icon> icons = new ArrayList<>();
                icons.add(Piece.Icon.Q);
                icons.add(Piece.Icon.K);
                return icons;
        }

        public ArrayList<Piece.Icon> whiteTestSet5()
        {
                ArrayList<Piece.Icon> icons = new ArrayList<>();
                icons.add(Piece.Icon.K);
                return icons;
        }

        public ArrayList<Piece.Icon> blackTestSet5()
        {
                ArrayList<Piece.Icon> icons = new ArrayList<>();
                icons.add(Piece.Icon.N);
                icons.add(Piece.Icon.B);
                icons.add(Piece.Icon.K);
                return icons;
        }

        public ArrayList<Piece.Icon> whiteTestSet6()
        {
                ArrayList<Piece.Icon> icons = new ArrayList<>();
                icons.add(Piece.Icon.K);
                return icons;
        }

        public ArrayList<Piece.Icon> blackTestSet6()
        {
                ArrayList<Piece.Icon> icons = new ArrayList<>();
                icons.add(Piece.Icon.N);
                icons.add(Piece.Icon.B);
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
