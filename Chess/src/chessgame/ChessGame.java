package chessgame;

import chessboard.Chessboard;

import pieces.Piece.Color;

import player.Computer;
import player.Human;
import player.Player;

public class ChessGame
{
	private enum CheckStatus
	{
		CHECKMATE, 
		ENEMY_CHECKED, 
		SELF_CHECKED,
		STALEMATE, 
		OK
	}
	public Chessboard board;
	public Player player1;
	public Player player2;
	public Player currentPlayer;

	public ChessGame()
	{
		this.board =  new Chessboard();
		this.player1 = new Human(board, Color.WHITE);
		this.player2 = new Computer(board, Color.BLACK, player1);
		// comment the two following lines, for using tests
//		setUp();
//		gameLoop();
	}

        public void setUp()
        {
        	currentPlayer = player2;
        }
        
        private void gameLoop()
        {
        	board.print();
        	for(;;) {
			changeCurrentPlayer();
			while(!currentPlayer.play());
			board.print();
			currentPlayer.verifyPawnPromotion();
			CheckStatus status = verifyGameStatus();
			if (status == CheckStatus.STALEMATE) {
				System.out.println("STALEMATE!");
				end();
			}
			if (status == CheckStatus.CHECKMATE ||
					status == CheckStatus.SELF_CHECKED) {
				System.out.println("CHECKMATE! + " + status);
				end();
			}
			if (status == CheckStatus.ENEMY_CHECKED) {
				System.out.println("CHECK!");
			}
        	}
        }
        
	private CheckStatus verifyGameStatus()
	{
		Player enemy = getCurrentEnemy();
		if (currentPlayer.isStalemate() || enemy.isStalemate())
			return CheckStatus.STALEMATE;
		else if(currentPlayer.kingIsCheckmated(enemy) ||
				enemy.kingIsCheckmated(currentPlayer))
			return CheckStatus.CHECKMATE;
		else if (enemy.kingIsChecked(currentPlayer.getPiecesAlive()))
			return CheckStatus.ENEMY_CHECKED;
		else if (currentPlayer.kingIsChecked(enemy.getPiecesAlive()))
			return CheckStatus.SELF_CHECKED;
		return CheckStatus.OK;
	}

	public void changeCurrentPlayer()
	{
		if (currentPlayer == player1)
			currentPlayer = player2;
		else
			currentPlayer = player1;
	}

	public Player getCurrentEnemy()
	{
	        if (currentPlayer == player1)
	        	return player2;
	        return player1;
	}

        private void end()
        {
		System.exit(0);
        }
}
