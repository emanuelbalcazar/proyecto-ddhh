CREATE OR REPLACE VIEW public.v_persons AS
SELECT
    p.*,
    (
        SELECT
            pc.photo
        FROM
            person_cases pc
        WHERE
            pc.person_id = p.id
        ORDER BY
            p.id DESC
        LIMIT 1
    ) as photo,
    count(a.id) AS count_alerts,
    max(
      CASE
          WHEN a.criticality::text = 'ROJO'::text THEN 3
          WHEN a.criticality::text = 'AMARILLO'::text THEN 2
          WHEN a.criticality::text = 'VERDE'::text THEN 1
          ELSE 0
      END
    ) AS max_criticality
FROM persons p
    LEFT JOIN alerts a ON p.id = a.person_id
GROUP BY
    p.id
ORDER BY
    p.id;
