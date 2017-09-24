package tests;

import org.junit.runner.RunWith;
import org.junit.runners.Suite;

@RunWith(Suite.class)

@Suite.SuiteClasses({
        CheckmateTest.class,
        StalemateTest.class,
        BishopTest.class,
        KingTest.class,
        KnightTest.class,
        PawnTest.class,
        QueenTest.class,
        RookTest.class,
        ComputerTest.class
})

public class TestSuite {}