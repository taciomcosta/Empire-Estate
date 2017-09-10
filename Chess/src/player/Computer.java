/*
* AI uses a production system (Minimax)
* REQUIREMENTS
* 1 - States (possible chessboard configurations)
* 2 - collection of production (Possible Moves)
* 3 - control system (chess rules embedded to pieces)
* */
package player;

import java.util.*;
import pieces.piece.Piece.Icon;
import pieces.Pawn;
import pieces.piece.Piece;
import pieces.piece.Piece.Color;
import chessboard.Chessboard;
import chessboard.Utils;

public class Computer extends Player
{
        private Player enemy;
	private Map<Character, Integer> piecesValues =
		new HashMap<>();

	public Computer(Chessboard b, Color piecesColor, Player enemy)
	{
		super(b, piecesColor);
		this.enemy = enemy;
		initPiecesValues();
	}

	@Override
	public void check_pawn_promotion()
	{
		ArrayList<Piece> capturedPieces;
//		for each pawn
		for (int i = 0; i < 8; i++) {
			Pawn pawn = (Pawn) pieces[i];
//			check if can be promoted
			if (pawn.can_be_promoted()) {
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
		Piece p = choose_pieceToMove_and_destination();
//		if there's no piece on destination
		if (board.getPieceAt(row, col) == null) {
//			if can move to destination, then move and end play
			if(p.canMove(row, col)) {
				p.move(row, col);
				System.out.println("Piece moved!");
				return true;
			}
		} else {
//			if can capture, then capture and end play
			if(p.canCapture(row, col)) {
				p.capture(board.getPieceAt(row, col));
				System.out.println("Piece captured!");
				return true;
			}
		}
		return false;
	}
	
	private Piece choose_pieceToMove_and_destination()
	{
//		get best move based on evaluation
                Move m = getBestMove(3);
//		set destination
		row = m.getFinalRow();
		col = m.getFinalCol();
//		return piece to move
		return m.getPiece();
	}
	
	private void initPiecesValues()
	{
		piecesValues.put('P', 1);
		piecesValues.put('N', 3);
		piecesValues.put('B', 3);
		piecesValues.put('R', 5);
		piecesValues.put('Q', 9);
		piecesValues.put('K', Integer.MAX_VALUE);
	}

	private int evaluatePiece(Piece piece)
	{
		return piecesValues.get(piece.
			toString().
			toUpperCase().
			charAt(0));
	}

	private int evaluateBoard(Chessboard board, Player pl)
	{
		int total = 0;
		Piece p;
		boolean friendKingAlive = false;
		boolean enemyKingAlive = false;
//		for each cell
		for (int i = 0; i < Utils.BOARD_LENGTH; ++i) {
			for (int j = 0; j < Utils.BOARD_LENGTH; ++j) {
				p = board.getPieceAt(i, j);
//				if there's no piece
				if (p == null)
					continue;
//				check if piece is a king
				if (p.getPieceInitial() == Icon.K) {
//                                	set its own king to alive
					if (p.getColor() == pl.getPiecesColor())
						friendKingAlive = true;
//                                	set its enemy king to alive
					else
						enemyKingAlive = true;
					continue;
				}
//			        if there's a piece and it's a friend
				if (p.hasSameColor(pl.getPiecesColor()))
					total += evaluatePiece(p);
				else
					total -= evaluatePiece(p);
			}
		}
//		if any king is not alive, return MIN/MAX value
		if (!friendKingAlive)
		        total = Integer.MIN_VALUE;
		else if (!enemyKingAlive)
			total = Integer.MAX_VALUE;
		// otherwise, return evaluation according to most valuable
                // pieces alive
	        return total;
	}

	private Move getBestMove(int depth)
	{
	        Move bestMove = null;
	        int minValue = Integer.MAX_VALUE;
                ArrayList<Move> moves = getPossibleMoves();
//		for each possible move
                for (Move m : moves) {
                        setState(m);
//                      compare values
			int currentValue = max(depth - 1);
			if (currentValue < minValue) {
				minValue = currentValue;
				bestMove = m;
			}
			unsetState(m);
                }
		return bestMove;
	}

	private int max(int depth)
	{
		ArrayList<Integer> minimums = new ArrayList<>();
//		get enemy possible moves
                ArrayList<Move> enemyMoves = enemy.getPossibleMoves();
//		for each possible move
                for (Move m : enemyMoves) {
                        setState(m);
//			if depth == 0 evaluate state
			if (depth == 0) {
				minimums.add(evaluateBoard(board, enemy));
//			else calculate children states until depth == 0
			} else {
				minimums.add(min(depth - 1));
			}
			unsetState(m);
                }
//		get minimum possibility
		int min = Integer.MAX_VALUE;
		for (Integer value : minimums)
			if (value < min)
				min = value;
		return min;
	}

	private int min(int depth)
	{
		ArrayList<Integer> maximums = new ArrayList<>();
                ArrayList<Move> moves = getPossibleMoves();
//		for each possible move
                for (Move m : moves) {
                	setState(m);
//			if depth == 0 evaluate state
                        if (depth == 0) {
                                maximums.add(evaluateBoard(board, this));
//			else calculate children states until depth == 0
                        } else {
                                maximums.add(max(depth - 1));
                        }
                        unsetState(m);
                }
//		get maximum possibility
		int max = Integer.MIN_VALUE;
		for (Integer value : maximums)
			if (value > max)
				max = value;
		return max;
	}

	private void moveTmp(Piece p, int destRow, int destCol)
	{
		board.removePiece(p.getRow(), p.getCol());
		board.addPiece(p, destRow, destCol);
		p.setRow(destRow);
		p.setCol(destCol);
		p.increaseMove();
	}

	private void unmoveTmp(Piece p, int startRow, int startCol)
	{
		board.removePiece(p.getRow(), p.getCol());
		board.addPiece(p, startRow, startCol);
		p.setRow(startRow);
		p.setCol(startCol);
		p.decreaseMove();
	}

	private void captureTmp(Piece p, Piece e, Move m)
	{
//		remove captured piece
                board.removePiece(m.getFinalRow(), m.getFinalCol());
                e.setCaptured(true);
		e.unsetPositionFromBoardRange();
//		move this to captured pieces' position
                board.removePiece(m.getStartRow(), m.getStartCol());
                board.addPiece(p, m.getFinalRow(), m.getFinalCol());
                p.setRow(m.getFinalRow());
                p.setCol(m.getFinalCol());
                p.increaseMove();
	}

	private void uncaptureTmp(Piece p, Piece e, Move m)
	{
//	        remove capturer piece
		board.removePiece(m.getFinalRow(), m.getFinalCol());
//		add capturer piece to its start position
		board.addPiece(p, m.getStartRow(), m.getStartCol());
		p.decreaseMove();
//		add captured piece back
                board.addPiece(e, m.getFinalRow(), m.getFinalCol());
                e.setCaptured(false);
                e.setRow(m.getFinalRow());
                e.setCol(m.getFinalCol());
	}

	private void setState(Move m)
	{
	        int finalRow = m.getFinalRow();
	        int finalCol = m.getFinalCol();
	        Piece p = m.getPiece();
	        Piece e = board.getPieceAt(finalRow, finalCol);
		m.setCapturedPiece(e);
//              do move/capture
		if (m.getType() == 'm')
			moveTmp(p, finalRow, finalCol);
		else
			captureTmp(p, e, m);
	}

	private void unsetState(Move m)
	{
		int startRow = m.getStartRow();
		int startCol = m.getStartCol();
		Piece p = m.getPiece();
		Piece e = m.getCapturedPiece();
//              undo move/capture
		if (m.getType() == 'm')
			unmoveTmp(p, startRow, startCol);
                else
                        uncaptureTmp(p, e, m);
	}
}

