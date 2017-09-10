package player;

import java.util.ArrayList;

import chessboard.Chessboard;

import pieces.Pawn;
import pieces.piece.Piece;
import pieces.piece.Piece.Color;

// TODO Refactor Human.java
public class Human extends Player 
{
	private Piece selectedPiece;

	public Human(Chessboard b, Color piecesColor)
	{
		super(b, piecesColor);
	}
	
	public Piece getSelectedPiece()
	{
		return this.selectedPiece;
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
//				print captured pieces' initials
				for (Piece piece : capturedPieces) {
					System.out.print(
							piece.getPieceInitial() +
							" ");
				}
				System.out.println();
//				get player input 
				System.out.print("Promote to: ");
				String userChoice = input.nextLine();
//				select piece
				Piece pieceToPromote = null; 
				for (Piece p : capturedPieces) {
					String pInitial = p.getPieceInitial().
							toString();
					if (userChoice.equals(pInitial)) {
						pieceToPromote = p;
						break;
					}
				}
//				finally, promote pawn
				pawn.promote(pieceToPromote);
			}
		}
	}
	
	public boolean play()
	{
//		get move
		System.out.print("(" + getPiecesColor() + ") Piece to move: ");
		String pos = input.nextLine();
		castPosition(pos);
//		try to select piece
		Piece p = board.getPieceAt(row, col); 
		if(p ==  null)
			return false;
//		check if it's a friendly piece
		if (!p.hasSameColor(getPiecesColor()))
			return false;
//		get destination
		System.out.print("(" + getPiecesColor() + ") Move to: ");
		pos = input.nextLine();
		castPosition(pos);
//		if there's a piece in destination
//		if can move to destination, then move and end play
		if(p.canMove(row, col)) {
			p.move(row, col);
			System.out.println("Piece moved!");
			return true;
//		if can capture, then capture and end play
		} else if(p.canCapture(row, col)) {
			p.capture(board.getPieceAt(row, col));
			System.out.println("Piece captured!");
			return true;
		}
		return false;
	}
}
