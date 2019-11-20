filename = "instrument_list.txt"
filename2 = "inst_adj.txt"
file2 = open(filename, "r")
file1 = open(filename2, "w+")
for line in file2:
   add = ('"') + line.strip() + ('",')
   file1.write(add)
