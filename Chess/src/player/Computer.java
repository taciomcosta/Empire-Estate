/*
* AI uses a production system (Minimax)
* REQUIREMENTS
* 1 - States (possible chessboard configurations)
* 2 - collection of production (Possible Moves)
* 3 - control system (chess rules embedded to pieces)
* */
package player;

import java.util.*;

import pieces.Icon;
import pieces.Pawn;
import pieces.Piece;
import pieces.Piece.Color;
import chessboard.Chessboard;

public class Computer extends Player
{
	private Player enemy;
	public static final int DEPTH = 4;

	public Computer(Chessboard b, Color piecesColor, Player enemy)
	{
		super(b, piecesColor);
		this.enemy = enemy;
	}

	@Override
	public void verifyPawnPromotion() { ArrayList<Piece> capturedPieces;
		for (int i = 0; i < 8; i++) {
			Pawn pawn = (Pawn) pieces[i];
			if (pawn.canBePromoted()) {
				capturedPieces = getCapturedPieces();
				if (capturedPieces.size() == 0)
					return;
				Piece pieceToPromoteTo =
					getMostValuablePiece(capturedPieces);
				pawn.promote(pieceToPromoteTo);
			}
		}
	}

	public Piece getMostValuablePiece(ArrayList<Piece> pieces)
	{
	        if (pieces.size() == 0)
	        	return null;
		Piece mostValuablePiece = pieces.get(0);
		for (Piece piece : pieces)
			if (piece.getValue() > mostValuablePiece.getValue())
				mostValuablePiece = piece;
		return mostValuablePiece;
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
                Move bestMove = getBestMove(DEPTH);
		row = bestMove.getFinalRow();
		col = bestMove.getFinalCol();
		return bestMove.getPiece();
	}

	public Move getBestMove(int depth)
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
		if (depth == 0 || someKingIsCaptured())
			return evaluateBoard();
		ArrayList<Integer> minimums = new ArrayList<>();
                ArrayList<Move> enemyMoves = enemy.getPossibleMoves();
                for (Move m : enemyMoves) {
                        enemy.setState(m);
			minimums.add(min(depth - 1));
			enemy.unsetState(m);
                }
		int min = Integer.MAX_VALUE;
		for (Integer value : minimums)
			if (value < min)
				min = value;
		return min;
	}

	private int min(int depth)
	{
		if (depth == 0 || someKingIsCaptured())
			return evaluateBoard();
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

	public int evaluateBoard()
	{
		int score = 0;
		if (pieces[Icon.K.getValue()].isCaptured())
			return Integer.MIN_VALUE;
		if (enemy.pieces[Icon.K.getValue()].isCaptured())
			return Integer.MAX_VALUE;
		for (Piece piece : getPiecesAlive())
			score += piece.getValue();
		for (Piece piece : enemy.getPiecesAlive())
			score -= piece.getValue();
		return score;
	}

	public boolean someKingIsCaptured()
	{
		return pieces[15].isCaptured() || enemy.pieces[15].isCaptured();
	}
}

