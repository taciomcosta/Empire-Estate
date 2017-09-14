package tests;

import chessboard.Chessboard;
import chessgame.ChessGame;
import pieces.*;
import pieces.piece.Piece;
import pieces.piece.Piece.Icon;
import pieces.piece.PieceModel;

import java.util.ArrayList;

public class CheckmateTest
{
        static ChessGame game = new ChessGame();
        static Chessboard board = game.model.board;
        static ArrayList<Piece> friend = game.model.player1.getPiecesAlive();
        static ArrayList<Piece> enemy = game.model.player2.getPiecesAlive();

        public static void main(String[] args)
        {
                King enemyKing = (King) enemy.get(15);
                King friendKing = (King) friend.get(15);
//              capture all enemy pieces except King
                for (Piece p : enemy) {
                        if (p.getPieceInitial() != Icon.K)
                                capture(p);
                }
//              capture all friend pieces except King and Rook
                for (Piece p : friend) {
                        if (p.getPieceInitial() != Icon.K &&
                                p.getPieceInitial() != Icon.B)
                                capture(p);
                }
//              get pieces
                Bishop friendBishop = (Bishop) friend.get(10);
//              move remaining pieces to right position
                move(enemyKing, 0, 1); //king
                move(friendBishop, 1, 1); //king
                move(friendKing, 2, 1);
//              print board
                board.printModel();
//              check conditions
                if (enemyKing.is_checkmated(game.model.player2, game.model.player1))
                        System.out.println("CHECKMATE!");
        }

        public static void capture(Piece p)
        {
                int enemyRow = p.getRow();
                int enemyCol = p.getCol();
//		remove captured piece
                board.removePiece(enemyRow, enemyCol);
                p.setCaptured(true);
//		move this to captured pieces' position
                p.unsetPositionFromBoardRange();
        }

        public static void move(Piece p, int row, int col)
        {
                PieceModel model = p.model;
                board.removePiece(p.getRow(), p.getCol());
                board.addPiece(p, row, col);
                model.setRow(row);
                model.setCol(col);
                p.increaseMoves();
        }
}
