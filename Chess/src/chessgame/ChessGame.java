package chessgame;

import chessboard.Chessboard;

import pieces.piece.Piece.Color;

import player.Computer;
import player.Human;
import player.Player;

public class ChessGame
{
	public enum CheckStatus {
		CHECKMATE, 
		ENEMY_CHECKED, 
		SELF_CHECKED,
		STALEMATE, 
		OK
	};
	public ChessGameModel model;

	public ChessGame()
	{
		Chessboard board = new Chessboard();
		Player p1 = new Human(board, Color.WHITE);
		Player p2 = new Computer(board, Color.BLACK, p1);
		model = new ChessGameModel(board, p1, p2);
//		setUp();
//		gameLoop();
	}

        public void setUp()
        {
//		set first current player
        	model.currentPlayer = model.player2;
        }
        
        public void gameLoop()
        {
        	model.board.printModel();
        	for(;;) {
			model.setCurrentPlayer();
//	        	while it's not a successfully play
			while(!model.currentPlayer.play());
//			print who played and board model
			System.out.println(model.getCurrentPlayer().getPiecesColor());
			model.board.printModel();
//			verify pawn promotion
			model.currentPlayer.promotePawn();
//			verify check status
			CheckStatus status = verify_status();
			if (status == CheckStatus.STALEMATE) {
				System.out.println("STALEMATE!");
				end();
			} else if (status == CheckStatus.CHECKMATE ||
					status == CheckStatus.SELF_CHECKED) {
				System.out.println("CHECKMATE! + " + status);
				end();
			} else if (status == CheckStatus.ENEMY_CHECKED) {
				System.out.println("CHECK!");
			}
        	}
        }
        
	public CheckStatus verify_status()
	{
		Player current = model.getCurrentPlayer();
		Player enemy = model.getEnemy();
//		verify stalemate
		if (current.is_stalemate() || enemy.is_stalemate())
			return CheckStatus.STALEMATE;
//	        verify checkmate
		else if(current.king_is_checkmated(enemy) || 
				enemy.king_is_checkmated(current))
			return CheckStatus.CHECKMATE;
//	       	verify check
		else if (enemy.king_is_checked(current.getPiecesAlive()))
			return CheckStatus.ENEMY_CHECKED;
		else if (current.king_is_checked(enemy.getPiecesAlive()))
			return CheckStatus.SELF_CHECKED;
		return CheckStatus.OK;
	}

        public void end()
        {
        	Player current = model.getCurrentPlayer();
        	Player enemy = model.getEnemy();
        	/*delete it */System.out.println(current.getPiecesColor() + " checkmated: " + current.king_is_checkmated(enemy));
        	System.out.println(enemy.getPiecesColor() + " checkmated: " + enemy.king_is_checkmated(current));
        	System.out.println("\nChecked");
        	System.out.println(current.getPiecesColor() + " checked: " + current.king_is_checked(enemy.getPiecesAlive()));
        	/**/ System.out.println(enemy.getPiecesColor() + " checked: " + enemy.king_is_checked(current.getPiecesAlive()));
		System.exit(0);
        }
}
