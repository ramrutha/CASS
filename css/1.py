#!/usr/bin/python
import itertools
li=[]
def permutationss(string, step = 0):
    # if we've gotten to the end, print the permutation
    if step == len(string):
        #print("".join(string))
        li.append("".join(string))
    # everything to the right of step has not been swapped yet
    for i in range(step, len(string)):

        # copy the string (store as array)
        string_copy = [character for character in string]

        # swap the current index with the step
        string_copy[step], string_copy[i] = string_copy[i], string_copy[step]

        # recurse on the portion of the string that has not been swapped yet (now it's index will begin with step + 1)
        permutationss(string_copy, step + 1)
inp=input()
flag=0
permutationss(inp)
for i in li:
    if i==i[::-1]:
        flag=1
        break
    else:
        flag=0
if flag==1:
    print("YES")
else:
    print("NO")