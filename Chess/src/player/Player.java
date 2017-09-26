package player;

import java.util.ArrayList;

import chessboard.Chessboard;
import chessboard.Utils;

import pieces.*;
import pieces.Piece;
import pieces.Piece.Color;

public abstract class Player
{
	public Piece[] pieces = new Piece[16];
	private Color piecesColor;
	protected Chessboard board;
	protected int row;
	protected int col;

	Player(Chessboard b, Color piecesColor)
	{
		this.piecesColor = piecesColor;
		this.board = b;
		if (this.piecesColor == Color.WHITE)
			initializeWhitePieces();
		else
			initializeBlackPieces();
	}

	public Piece[] getPieces()
	{
		return pieces;
	}
	
	private Piece getPiece(int i)
	{
		return pieces[i];
	}

	private void initializeWhitePieces()
	{
		for (int i = 0; i < 8; i++)
			pieces[Icon.P.getValue() + i] =
				new Pawn(Color.WHITE, board, 6, i);
		pieces[Icon.R.getValue()] =
			new Rook(Color.WHITE, board, 7, 0);
		pieces[Icon.R.getValue() + 1] =
			new Rook(Color.WHITE, board, 7, 7);
		pieces[Icon.B.getValue()] =
			new Bishop(Color.WHITE, board, 7, 2);
		pieces[Icon.B.getValue() + 1] =
			new Bishop(Color.WHITE, board, 7, 5);
		pieces[Icon.N.getValue()] =
			new Knight(Color.WHITE, board, 7, 6);
		pieces[Icon.N.getValue() + 1] =
			new Knight(Color.WHITE, board, 7, 1);
		pieces[Icon.Q.getValue()] =
			new Queen(Color.WHITE, board, 7, 3);
		pieces[Icon.K.getValue()] =
			new King(Color.WHITE, board, 7, 4);
	}

	private void initializeBlackPieces()
	{
		for (int i = 0; i < 8; i++)
			pieces[Icon.P.getValue() + i] =
				new Pawn(Color.BLACK, board, 1, i);
		pieces[Icon.R.getValue()] =
			new Rook(Color.BLACK, board, 0, 0);
		pieces[Icon.R.getValue() + 1] =
			new Rook(Color.BLACK, board, 0, 7);
		pieces[Icon.B.getValue()] =
			new Bishop(Color.BLACK, board, 0, 2);
		pieces[Icon.B.getValue() + 1] =
			new Bishop(Color.BLACK, board, 0, 5);
		pieces[Icon.N.getValue()] =
			new Knight(Color.BLACK, board, 0, 6);
		pieces[Icon.N.getValue() + 1] =
			new Knight(Color.BLACK, board, 0, 1);
		pieces[Icon.Q.getValue()] =
			new Queen(Color.BLACK, board, 0, 3);
		pieces[Icon.K.getValue()] =
			new King(Color.BLACK, board, 0, 4);
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
		for (int i = 0; i < Utils.BOARD_LENGTH; ++i) {
			for (int j = 0; j < Utils.BOARD_LENGTH; ++j) {
				Piece p = board.getPieceAt(i, j);
				if (p != null)
					if (p.hasSameColor(getPiecesColor()))
						piecesAlive.add(p);
			}
		}
		return piecesAlive;
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

	ArrayList<Move> getPossibleMoves()
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


	void setState(Move move)
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

	void unsetState(Move move)
	{
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
		board.removePiece(move.getFinalRow(), move.getFinalCol());
		e.setCaptured(true);
		e.unsetPositionFromBoardRange();
		board.removePiece(move.getStartRow(), move.getStartCol());
		board.addPiece(p, move.getFinalRow(), move.getFinalCol());
		p.setRow(move.getFinalRow());
		p.setCol(move.getFinalCol());
		p.increaseMoves();
	}

	private void uncaptureTmp(Piece p, Piece e, Move m)
	{
		board.removePiece(m.getFinalRow(), m.getFinalCol());
		board.addPiece(p, m.getStartRow(), m.getStartCol());
		p.setRow(m.getStartRow());
		p.setCol(m.getStartCol());
		p.decreaseMoves();
		board.addPiece(e, m.getFinalRow(), m.getFinalCol());
		e.setCaptured(false);
		e.setRow(m.getFinalRow());
		e.setCol(m.getFinalCol());
	}

	public boolean play()
	{
		Piece pieceToMove = choosePieceToMoveAndDestination();
		Piece pieceToBeCaptured;
		System.out.println("---------------------------------");
		if(pieceToMove.canMove(row, col)) {
			pieceToMove.move(row, col);
			System.out.println("Piece moved!");
			return true;
		}
		pieceToBeCaptured = board.getPieceAt(row, col);
		if (pieceToMove.canCapture(row, col) &&
			pieceToBeCaptured != null) {
			pieceToMove.capture(pieceToBeCaptured);
			System.out.println("Piece captured!");
			return true;
		}
		if (canCaptureByEnPassant(pieceToMove, pieceToBeCaptured)) {
		        pieceToBeCaptured = board.getPieceAt(
		        	pieceToMove.getRow(),
				col
			);
		        pieceToMove.capture(pieceToBeCaptured);
			System.out.println("Piece captured! (En passant)");
			return true;
		}
		return false;
	}

	private boolean canCaptureByEnPassant(Piece pieceToMove,
					     Piece pieceToBeCaptured)
	{
		return pieceToMove.getPieceInitial() == Icon.P &&
			pieceToBeCaptured == null &&
			pieceToMove.canCapture(pieceToMove.getRow(), col);
	}

	abstract Piece choosePieceToMoveAndDestination();
	public abstract void verifyPawnPromotion();
}
