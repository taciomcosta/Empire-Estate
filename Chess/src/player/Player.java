package player;

import java.util.ArrayList;
import java.util.Comparator;
import java.util.Scanner;

import chessboard.Chessboard;
import chessboard.Utils;

import pieces.Bishop;
import pieces.King;
import pieces.Knight;
import pieces.Pawn;
import pieces.piece.Piece;
import pieces.piece.Piece.Color;
import pieces.piece.Piece.Icon;
import pieces.Queen;
import pieces.Rook;

// TODO Refactor Player.java
public abstract class Player
{
	protected Scanner input = new Scanner(System.in);
	protected int row;
	protected int col;
	protected Color piecesColor;
	protected Piece[] pieces = new Piece[16];
	protected Chessboard board;

	public Player(Chessboard b, Color piecesColor)
	{
		setPiecesColor(piecesColor);
		setChessboard(b);
		setPieces();
	}

	public Piece[] getPieces()
	{
		return pieces;
	}
	
	protected ArrayList<Piece> getEnemyPiecesAlive()
	{
		ArrayList<Piece> enemies = new ArrayList<Piece>();
		Color c = getPiecesColor();
		for (int i = 0; i < Utils.BOARD_LENGTH; ++i) {
			for (int j = 0; j < Utils.BOARD_LENGTH; ++j) {
				Piece enemy = board.getPieceAt(i, j); 
				if (enemy != null)
				if (enemy.getColor() != c && 
						!enemy.isCaptured())
					enemies.add(enemy);
			}
		}
		return enemies;
	}
	
	public Piece getPiece(int i)
	{
		return pieces[i];
	}

	private void setPieces()
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
		ArrayList<Piece> capturedPieces = new ArrayList<Piece>();
//		for each piece
		for (Piece p : pieces) {
//			add to array, if it's captured
			if (p.isCaptured())
				capturedPieces.add(p);
		}
		return capturedPieces;
	}

	public ArrayList<Piece> getPiecesAlive()
	{
		ArrayList<Piece> piecesAlive = new ArrayList<>();
//		for each piece
		for (Piece p : pieces) {
//			add to array, if it's captured
			if (!p.isCaptured())
				piecesAlive.add(p);
		}
		System.out.println(piecesAlive.size());
		return piecesAlive;
	}
	
	private void setPiecesColor(Color piecesColor)
	{
		this.piecesColor = piecesColor;
	}
	
	public boolean king_is_checked(ArrayList<Piece> enemyPieces)
	{
		King k = (King) getPiece(15);
		return k.is_checked(enemyPieces);
	}

	public boolean king_is_checkmated(Player enemy)
	{
		King k = (King) getPiece(15);
		return k.is_checkmated(this, enemy);
	}
	
	public void setChessboard(Chessboard board)
	{
		this.board = board;
	}
	

	public void castPosition(String pos)
	{
//		cast row and col. Ex: A5 -> col=0, row=3
		col = pos.charAt(0) - 97;
		row = 8 - Integer.parseInt(pos.substring(1, 2));
	}

	
	public void check_pawn_promotion()
	{
	}
	
	public boolean is_stalemate(ArrayList <Piece> enemyPieces)
	{
//		get its own king
		King king = (King) pieces[15];
//		if king is checked, then it can't be a stalemate
		if (king.is_checked())
			return false;
//		get friend pieces alive that can move
		ArrayList <Piece> moveable = new ArrayList<Piece>();
		for (Piece p : getPiecesAlive()) {
			for (int i = 0; i < Utils.BOARD_LENGTH; i++) {
				for (int j = 0; j < Utils.BOARD_LENGTH; j++) {
				        boolean r = p.getPieceInitial() != Icon.K;
				        boolean s = p.canMove(i, j);
				        boolean t = !moveable.contains(p);
					if (r && s && t)
						moveable.add(p);
				}
			}
		}
//		for each piece that can move 
		int wouldLetKingChecked = 0;
		for (Piece p : moveable) {
//			backup piece pos, for removing it temporarily
			int backupRow = p.getRow();
			int backupCol = p.getCol();
//			remove piece from board
			board.removePiece(backupRow, backupCol);
			p.setRow(Integer.MIN_VALUE);
			p.setCol(Integer.MIN_VALUE);
			p.setCaptured(true);
//			verify if king could be checked
//			without piece
			boolean isChecked = king.is_checked();
//			add piece back
			board.addPiece(p, backupRow, backupCol);
			p.setRow(backupRow);
			p.setCol(backupCol);
			p.setCaptured(false);
			if (isChecked)
				wouldLetKingChecked++;
		}
//		check if all pieces that can move would let king in check
		if (moveable.size() != wouldLetKingChecked) 
			return false;
//		check if king can move safely
		for (int i = -1; i < 2; i++) {
			for (int j = -1; j < 2; j++) {
//				set propositions
				boolean p = king.would_be_checked(enemyPieces, 
						king.getRow() + i, 
						king.getCol() + j); 
				boolean q = board.getPieceAt(i, j) == null;
				boolean r = i != 0 || j != 0;
//				check them
				if (!p && q && r) {
//					TEST: System.out.println("can move safely " + (king.getRow() + i) + " " + (king.getCol() + j));
					return false;
				}
			}
		}
		return true;
	}

	protected ArrayList<Move> getPossibleMoves()
	{
	        ArrayList<Move> possibleMoves = new ArrayList<Move>();
//	        get pieces alive
		ArrayList<Piece> piecesAlive = getPiecesAlive();
//		for each cell in chessboard
		for (int i = 0; i < Utils.BOARD_LENGTH; ++i) {
			for (int j = 0; j < Utils.BOARD_LENGTH; ++j) {
//				check what pieces can move/capture to it
				for (Piece p : piecesAlive) {
					boolean q = p.canMove(i, j);
					boolean r = p.canCapture(i, j);
					boolean s = board.getPieceAt(i, j)
						!= null;
					if (q) {
						possibleMoves.add(
							new Move(p,
								'm',
								i,
								j));
					} else if (r && s) {
						possibleMoves.add(
							new Move(p,
								'c',
								i,
								j));
					}
				}
			}
		}
//		sort possibleMoves by piece
		possibleMoves.sort(new Comparator<Move>() {
			@Override
			public int compare(Move m, Move m1)
			{
				char p1 = m.getPiece().toString().charAt(0);
				char p2 = m1.getPiece().toString().charAt(0);
				if (p1 > p2)
					return 1;
				if (p1 < p2)
					return -1;
				return 0;
			}
		});
		return possibleMoves;
	}

	public abstract boolean play();
}
