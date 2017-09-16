package player;

import java.util.ArrayList;

import chessboard.Chessboard;
import chessboard.Utils;

import pieces.Bishop;
import pieces.King;
import pieces.Knight;
import pieces.Pawn;
import pieces.piece.Piece;
import pieces.piece.Piece.Color;
import pieces.Queen;
import pieces.Rook;

public abstract class Player
{
	protected Player enemy;
	public Piece[] pieces = new Piece[16];
	private Color piecesColor;
	protected Chessboard board;
	protected int row;
	protected int col;

	protected Player(Chessboard b, Color piecesColor)
	{
		setPiecesColor(piecesColor);
		setChessboard(b);
		initializePieces();
	}

	public Piece[] getPieces()
	{
		return pieces;
	}
	
	private Piece getPiece(int i)
	{
		return pieces[i];
	}

	private void initializePieces()
	{
//		FOR BLACK PIECES
		if (getPiecesColor() == Color.BLACK) {
//			set pawns
			for (int i = 0; i < 8; i++)
				pieces[i] = new Pawn(Color.BLACK, board, 1, i);
//	              	set Rooks
			pieces[8] = new Rook(Color.BLACK, board, 0, 0);
			pieces[9] = new Rook(Color.BLACK, board, 0, 7);
//	                set Bishops
			pieces[10] = new Bishop(Color.BLACK, board, 0, 2);
			pieces[11] = new Bishop(Color.BLACK, board, 0, 5);
//	              	set Knight
			pieces[12] = new Knight(Color.BLACK, board, 0, 6);
			pieces[13] = new Knight(Color.BLACK, board, 0, 1);
//	            	set Queen
			pieces[14] = new Queen(Color.BLACK, board, 0, 3);
//	              	set Kings
			pieces[15] = new King(Color.BLACK, board, 0, 4);
//		FOR WHITE PIECES
		} else {
//			set pawns
			for (int i = 0; i < 8; i++)
				pieces[i] = new Pawn(Color.WHITE, board, 6, i);
//	              	set Rooks
			pieces[8] = new Rook(Color.WHITE, board, 7, 0);
			pieces[9] = new Rook(Color.WHITE, board, 7, 7);
//	                set Bishops 
			pieces[10] = new Bishop(Color.WHITE, board, 7, 2);
			pieces[11] = new Bishop(Color.WHITE, board, 7, 5);
//	              	set Knight 
			pieces[12] = new Knight(Color.WHITE, board, 7, 6);
			pieces[13] = new Knight(Color.WHITE, board, 7, 1);
//	            	set Queen
			pieces[14] = new Queen(Color.WHITE, board, 7, 3);
//	              	set Kings
			pieces[15] = new King(Color.WHITE, board, 7, 4);
		}
	}
	
	public Color getPiecesColor()
	{
		return this.piecesColor;
	}
	
	public ArrayList<Piece> getCapturedPieces()
	{
		ArrayList<Piece> capturedPieces = new ArrayList<>();
		for (Piece p : pieces) {
			if (p.isCaptured())
				capturedPieces.add(p);
		}
		return capturedPieces;
	}

	public ArrayList<Piece> getPiecesAlive()
	{
		ArrayList<Piece> piecesAlive = new ArrayList<>();
		for (Piece p : pieces) {
			if (!p.isCaptured())
				piecesAlive.add(p);
		}
		// =========================================== remove line below
		System.out.println(piecesAlive.size());
		return piecesAlive;
	}
	
	private void setPiecesColor(Color piecesColor)
	{
		this.piecesColor = piecesColor;
	}
	
	public boolean kingIsChecked(ArrayList<Piece> enemyPieces)
	{
		King k = (King) getPiece(15);
		return k.isChecked(enemyPieces);
	}

	public boolean kingIsCheckmated(Player enemy)
	{
		King k = (King) getPiece(15);
		return k.isCheckmated(this, enemy);
	}
	
	public void setChessboard(Chessboard board)
	{
		this.board = board;
	}
	
	/*
	* Stalemate requisites:
	* - King is not checked
	* - There's no legal moves but checkmating its own King
	* */
	public boolean isStalemate()
	{
		King king = (King) pieces[15];
		int kingRow = king.getRow();
		int kingCol = king.getCol();
		if (king.isChecked())
			return false;
		ArrayList<Move> legalMoves = getPossibleMoves();
		for (Move move : legalMoves) {
		        boolean p = !kingWouldBeChecked(move);
		        boolean q = move.getFinalRow() != kingRow;
			boolean s = move.getFinalCol() != kingCol;
			if (p && q && s)
				return false;
		}
		return true;
	}

	public ArrayList<Move> getPossibleMoves()
	{
	        ArrayList<Move> possibleMoves = new ArrayList<>();
		for (int row = 0; row < Utils.BOARD_LENGTH; ++row)
			for (int col = 0; col < Utils.BOARD_LENGTH; ++col)
				addMovablePieces(possibleMoves, row, col);
		return possibleMoves;
	}

	private void addMovablePieces(ArrayList<Move> possibleMoves,
				      int finalRow,
				      int finalCol)
	{
		ArrayList<Piece> piecesAlive = getPiecesAlive();
		for (Piece piece : piecesAlive) {
			boolean q = piece.canMove(finalRow, finalCol);
			boolean r = piece.canCapture(finalRow, finalCol);
			boolean s = board.getPieceAt(finalRow, finalCol) != null;
			if (q) {
				possibleMoves.add(
					new Move(piece,
						Move.MoveType.MOVE,
						finalRow,
						finalCol));
			} else if (r && s) {
				possibleMoves.add(
					new Move(piece,
						Move.MoveType.CAPTURE,
						finalRow,
						finalCol));
			}
		}
	}

	private boolean kingWouldBeChecked(Move move)
	{
		King king = (King) pieces[15];
		setState(move);
		boolean wouldBeChecked = king.isChecked();
		unsetState(move);
		return wouldBeChecked;
	}

	protected void setState(Move move)
	{
		int finalRow = move.getFinalRow();
		int finalCol = move.getFinalCol();
		Piece p = move.getPiece();
		Piece e = board.getPieceAt(finalRow, finalCol);
		move.setCapturedPiece(e);
		if (move.getType() == Move.MoveType.MOVE)
			moveTmp(p, finalRow, finalCol);
		else
			captureTmp(p, e, move);
	}

	protected void unsetState(Move move)
	{
	        System.out.println(move.toString() + move.getType().toString());
		int startRow = move.getStartRow();
		int startCol = move.getStartCol();
		Piece p = move.getPiece();
		Piece e = move.getCapturedPiece();
		if (move.getType() == Move.MoveType.MOVE)
			unmoveTmp(p, startRow, startCol);
		else
			uncaptureTmp(p, e, move);
	}

	private void moveTmp(Piece p, int destRow, int destCol)
	{
		board.removePiece(p.getRow(), p.getCol());
		board.addPiece(p, destRow, destCol);
		p.setRow(destRow);
		p.setCol(destCol);
		p.increaseMoves();
	}

	private void unmoveTmp(Piece p, int startRow, int startCol)
	{
		board.removePiece(p.getRow(), p.getCol());
		board.addPiece(p, startRow, startCol);
		p.setRow(startRow);
		p.setCol(startCol);
		p.decreaseMoves();
	}

	private void captureTmp(Piece p, Piece e, Move move)
	{
	        System.out.println("============= captureTmp");
	        System.out.println(move.getPiece().getPieceInitial() + move.getPiece().getColor().toString());
		System.out.println(move.toString() + move.getType().toString());
//		remove captured piece
		board.removePiece(move.getFinalRow(), move.getFinalCol());
		e.setCaptured(true);
		e.unsetPositionFromBoardRange();
//		move this to captured pieces' position
		board.removePiece(move.getStartRow(), move.getStartCol());
		board.addPiece(p, move.getFinalRow(), move.getFinalCol());
		p.setRow(move.getFinalRow());
		p.setCol(move.getFinalCol());
		p.increaseMoves();
		System.out.println("============================");
	}

	private void uncaptureTmp(Piece p, Piece e, Move m)
	{
//	        remove capturer piece
		board.removePiece(m.getFinalRow(), m.getFinalCol());
//		add capturer piece to its start position
		board.addPiece(p, m.getStartRow(), m.getStartCol());
		p.decreaseMoves();
//		add captured piece back
		board.addPiece(e, m.getFinalRow(), m.getFinalCol());
		e.setCaptured(false);
		e.setRow(m.getFinalRow());
		e.setCol(m.getFinalCol());
	}

	protected int evaluateBoard()
	{
		int score = 0;
		if (pieces[15].isCaptured())
			return Integer.MIN_VALUE;
		if (enemy.pieces[15].isCaptured())
			return Integer.MAX_VALUE;
		for (Piece piece : getPiecesAlive()) {
			score += piece.getValue();
		}
		for (Piece piece : getPiecesAlive()) {
			score -= piece.getValue();
		}
		return score;
	}

	public abstract boolean play();
	public abstract void verifyPawnPromotion();
}
