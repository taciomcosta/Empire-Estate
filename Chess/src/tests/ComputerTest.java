package tests;

import chessgame.ChessGame;
import junit.framework.TestCase;
import player.Player;

public class ComputerTest extends TestCase
{
        private ChessGame game = new ChessGame();
        private Player f = game.model.player1;
        private Player e = game.model.player2;

        public void setUp() throws Exception
        {
                super.setUp();
        }

        public void testPlay() throws Exception
        {
        }

}