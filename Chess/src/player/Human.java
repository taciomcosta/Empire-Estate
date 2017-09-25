package player;

import java.util.ArrayList;
import java.util.Scanner;

import chessboard.Chessboard;

import pieces.Pawn;
import pieces.Piece;
import pieces.Piece.Color;

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
			if (pawn.canBePromoted()) {
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

	@Override
	Piece choosePieceToMoveAndDestination()
	{
		Piece pieceToMove = pickPieceToMove();
		pickDestination();
		return pieceToMove;
	}

	private Piece pickPieceToMove()
	{
	        Piece pieceToMove;
	        do {
			System.out.print("(" + getPiecesColor() +
				") Piece to move: ");
			String pos = input.nextLine();
			castPosition(pos);
			pieceToMove = board.getPieceAt(row, col);
		} while (pieceToMove == null ||
			!pieceToMove.hasSameColor(getPiecesColor()) );
		return pieceToMove;
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
