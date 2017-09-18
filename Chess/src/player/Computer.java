/*
* AI uses a production system (Minimax)
* REQUIREMENTS
* 1 - States (possible chessboard configurations)
* 2 - collection of production (Possible Moves)
* 3 - control system (chess rules embedded to pieces)
* */
package player;

import java.util.*;
import pieces.Pawn;
import pieces.piece.Piece;
import pieces.piece.Piece.Color;
import chessboard.Chessboard;

public class Computer extends Player
{
	private Player enemy;

	public Computer(Chessboard b, Color piecesColor, Player enemy)
	{
		super(b, piecesColor);
		this.enemy = enemy;
	}

	@Override
	public void verifyPawnPromotion()
	{
		ArrayList<Piece> capturedPieces;
//		for each pawn
		for (int i = 0; i < 8; i++) {
			Pawn pawn = (Pawn) pieces[i];
//			check if can be promoted
			if (pawn.canBePromoted()) {
//				get captured pieces
				capturedPieces = getCapturedPieces();
//				if there's no captured piece, return
				if (capturedPieces.size() == 0)
					return;
//				choose piece
				Random r = new Random();
				int n = r.nextInt(capturedPieces.size());
//				select piece
				Piece pieceToPromote = capturedPieces.get(n);
//				finally, promote pawn
				pawn.promote(pieceToPromote);
			}
		}
	}

	@Override
	public boolean play()
	{
		Piece pieceToMove = choosePieceToMoveAndDestination();
                if(pieceToMove.canMove(row, col)) {
			pieceToMove.move(row, col);
			System.out.println("Piece moved!");
			return true;
		}
                if (pieceToMove.canCapture(row, col) &&
                        board.getPieceAt(row, col) != null) {
                        pieceToMove.capture(board.getPieceAt(row, col));
                        System.out.println("Piece captured!");
                        return true;
                }
		return false;
	}
	
	private Piece choosePieceToMoveAndDestination()
	{
                Move bestMove = getBestMove(2);
		row = bestMove.getFinalRow();
		col = bestMove.getFinalCol();
		return bestMove.getPiece();
	}
	
	private Move getBestMove(int depth)
	{
	        Move bestMove = null;
	        int maxValue = Integer.MIN_VALUE;
                ArrayList<Move> moves = getPossibleMoves();
                for (Move m : moves) {
                        setState(m);
			int currentValue = max(depth - 1);
			if (currentValue > maxValue) {
				maxValue = currentValue;
				bestMove = m;
			}
			unsetState(m);
                }
		return bestMove;
	}

	private int max(int depth)
	{
		if (depth == 0)
			return evaluateBoard(enemy, this);
		ArrayList<Integer> minimums = new ArrayList<>();
                ArrayList<Move> enemyMoves = enemy.getPossibleMoves();
                for (Move m : enemyMoves) {
                        setState(m);
			minimums.add(min(depth - 1));
			unsetState(m);
                }
		int min = Integer.MAX_VALUE;
		for (Integer value : minimums)
			if (value < min)
				min = value;
		return min;
	}

	private int min(int depth)
	{
		if (depth == 0)
			return evaluateBoard(this, enemy);
		ArrayList<Integer> maximums = new ArrayList<>();
                ArrayList<Move> moves = getPossibleMoves();
                for (Move m : moves) {
                	setState(m);
			maximums.add(max(depth - 1));
                        unsetState(m);
                }
		int max = Integer.MIN_VALUE;
		for (Integer value : maximums)
			if (value > max)
				max = value;
		return max;
	}

	protected int evaluateBoard(Player currentPlayer, Player enemyPlayer)
	{
		int score = 0;
		if (currentPlayer.pieces[15].isCaptured())
			return Integer.MIN_VALUE;
		if (enemyPlayer.pieces[15].isCaptured())
			return Integer.MAX_VALUE;
		for (Piece piece : currentPlayer.getPiecesAlive()) {
			score += piece.getValue();
		}
		for (Piece piece : enemyPlayer.getPiecesAlive()) {
			score -= piece.getValue();
		}
		return score;
	}

	// delete it
	public void printBoard()
	{
		for (int i = 0; i < 8; i++) {
			System.out.print((8 - i) + " | ");
			for (int j = 0; j < 8; j++) {
				Piece p = board.getPieceAt(i, j);
				if (p != null) {
					System.out.print(p.getRow() + "" + p.getCol() + "  ");
				}
				else
					System.out.print("-  ");
			}
			System.out.println();
		}
		System.out.println("    ------------------------------------");
		System.out.println("    a  b  c  d  e  f  g  h\n");
	}
}

