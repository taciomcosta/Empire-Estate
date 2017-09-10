package chessgame;

import chessboard.Chessboard;

import player.Player;

public class ChessGameModel
{
	public Chessboard board;
	public Player player1;
	public Player player2;
	public Player currentPlayer;

	public ChessGameModel(Chessboard board, Player player1, Player player2)
	{
		this.board =  board;
		this.player1 = player1;
		this.player2 = player2;
	}

	public void setCurrentPlayer()
	{
		if (getCurrentPlayer() == player1)
			currentPlayer = player2;
		else
			currentPlayer = player1;
	}

	public Player getCurrentPlayer()
	{
		return this.currentPlayer;
	}
	
	public Player getEnemy()
	{
		return currentPlayer == player1 ? player2 : player1;
	}
}
