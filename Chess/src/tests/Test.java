package tests;

import chessboard.Chessboard;
import chessgame.ChessGame;
import pieces.Icon;
import pieces.piece.Piece;
import player.Player;

import java.util.ArrayList;

public abstract class Test
{
        public ChessGame game;
        public Player whitePlayer;
        public Player blackPlayer;
        public Chessboard board;

        public void removePiecesDifferent(Player player,
                                          ArrayList<Icon> piecesIcon)
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

        boolean[][] getCaptureMap(Piece piece)
        {
                boolean[][] map = new boolean[8][8];
                for (int i = 0; i < 8; ++i)
                        for (int j = 0; j < 8; ++j)
                                map[i][j] = piece.canCapture(i, j);
                return map;
        }

        boolean[][] getMoveMap(Piece piece)
        {
                boolean[][] map = new boolean[8][8];
                for (int i = 0; i < 8; ++i)
                        for (int j = 0; j < 8; ++j)
                                map[i][j] = piece.canMove(i, j);
                return map;
        }

        public void printMap(boolean[][] map)
        {
                for (int i = 0; i < 8; ++i) {
                        for (int j = 0; j < 8; ++j) {
                                if (map[i][j])
                                        System.out.print("T ");
                                else
                                        System.out.print("F ");
                        }
                        System.out.println();
                }
        }

        public void resetElements()
        {
                game = new ChessGame();
                whitePlayer = game.player1;
                blackPlayer = game.player2;
                board = game.board;
        }
}
