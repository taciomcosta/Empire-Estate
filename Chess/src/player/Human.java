package player;

import java.util.ArrayList;
import java.util.Scanner;

import chessboard.Chessboard;

import pieces.Pawn;
import pieces.piece.Piece;
import pieces.piece.Piece.Color;

public class Human extends Player
{
	protected Scanner input = new Scanner(System.in); // remove it

	public Human(Chessboard b, Color piecesColor)
	{
		super(b, piecesColor);
	}

	@Override
	public void verifyPawnPromotion()
	{
		ArrayList<Piece> capturedPieces = getCapturedPieces();
		if (capturedPieces.size() == 0)
			return;
		for (int i = 0; i < 8; i++) {
			Pawn pawn = (Pawn) pieces[i];
			if (pawn.can_be_promoted()) {
				pawn.promote(pickCapturedPiece(capturedPieces));
				return;
			}
		}
	}

	private Piece pickCapturedPiece(ArrayList<Piece> capturedPieces)
	{
		for (Piece piece : capturedPieces)
			System.out.print(piece.getPieceInitial() + " ");
		System.out.println();
		System.out.print("Choose a captured piece: ");
		String userChoice = input.nextLine();
		Piece pieceToPromote = null;
		for (Piece p : capturedPieces) {
			String pInitial = p.getPieceInitial().
				toString();
			if (userChoice.equals(pInitial)) {
				pieceToPromote = p;
				break;
			}
		}
		return pieceToPromote;
	}
	
	public boolean play()
	{
	        Piece piece = pickPieceToMove();
		if(piece ==  null)
			return false;
		pickDestination();
		if(piece.canMove(row, col)) {
			piece.move(row, col);
			System.out.println("Piece moved!");
			return true;
		} else if(piece.canCapture(row, col)) {
			piece.capture(board.getPieceAt(row, col));
			System.out.println("Piece captured!");
			return true;
		}
		return false;
	}

	private Piece pickPieceToMove()
	{
		System.out.print("(" + getPiecesColor() + ") Piece to move: ");
		String pos = input.nextLine();
		castPosition(pos);
		Piece piece = board.getPieceAt(row, col);
		if (!piece.hasSameColor(getPiecesColor()))
			return null;
		return piece;
	}

	private void pickDestination()
	{
		System.out.print("(" + getPiecesColor() + ") Move to: ");
		String pos = input.nextLine();
		castPosition(pos);
	}

	protected void castPosition(String pos)
	{
//		cast row and col. Ex: A5 -> col=0, row=3
		col = pos.charAt(0) - 97;
		row = 8 - Integer.parseInt(pos.substring(1, 2));
	}
}
