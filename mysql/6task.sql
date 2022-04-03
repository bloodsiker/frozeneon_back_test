SELECT
    object_id as boosterpack,
    SUM(CASE
            WHEN object = 'boosterpack' AND action = 'buy_boosterpack' THEN amount
    	ELSE 0
      END
   ) sum_amount,
    (SELECT
         SUM(amount)
     FROM analytics a2
     WHERE object = 'like'
       AND action = 'add_like'
    AND a1.object_id = a2.object_id
    AND a2.time_created > DATE_SUB(NOW(), INTERVAL 30 DAY)
    AND DATE_FORMAT(a1.time_created, '%Y-%m-%d %H') = DATE_FORMAT(a2.time_created, '%Y-%m-%d %H')
    ) as sum_likes,
    DATE_FORMAT(`time_created`, '%Y-%m-%d %H') as time
FROM analytics a1
WHERE object = 'boosterpack' AND time_created > DATE_SUB(NOW(), INTERVAL 30 DAY)
GROUP BY DATE_FORMAT(time_created, '%Y-%m-%d %H'), object_id
ORDER BY DATE_FORMAT(time_created, '%Y-%m-%d %H');


SELECT
    user_id,
    user.personaname,
    SUM(CASE
            WHEN object = 'wallet' AND action = 'add_money' THEN amount
    	    ELSE 0
        END
   ) sum_amount,
    SUM(CASE
            WHEN object = 'like' AND action = 'add_like' THEN amount
    	    ELSE 0
        END
   ) sum_like,
    SUM(CASE
            WHEN object = 'wallet' AND action = 'add_money' THEN amount
            WHEN object = 'boosterpack' AND action = 'buy_boosterpack' THEN -amount
    	    ELSE 0
        END
    ) balance,
    SUM(CASE
            WHEN object = 'like' AND action = 'add_like' THEN amount
            WHEN (object = 'post' OR object = 'comment') AND action = 'like' THEN -amount
    	    ELSE 0
        END
    ) likes
FROM analytics
    INNER JOIN user ON analytics.user_id = user.id
GROUP BY user_id;
