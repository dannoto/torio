# This is Python port of this Javascript method: 
# https://github.com/notslang/instagram-id-to-url-segment/blob/master/lib/index.coffee

url = "https://www.instagram.com/p/CiI7SuEOCy2/"
# ----> use regexp to extract code from url
code = "CiI7SuEOCy2"

charmap = {
    'A': '0',
    'B': '1',
    'C': '2',
    'D': '3',
    'E': '4',
    'F': '5',
    'G': '6',
    'H': '7',
    'I': '8',
    'J': '9',
    'K': 'a',
    'L': 'b',
    'M': 'c',
    'N': 'd',
    'O': 'e',
    'P': 'f',
    'Q': 'g',
    'R': 'h',
    'S': 'i',
    'T': 'j',
    'U': 'k',
    'V': 'l',
    'W': 'm',
    'X': 'n',
    'Y': 'o',
    'Z': 'p',
    'a': 'q',
    'b': 'r',
    'c': 's',
    'd': 't',
    'e': 'u',
    'f': 'v',
    'g': 'w',
    'h': 'x',
    'i': 'y',
    'j': 'z',
    'k': 'A',
    'l': 'B',
    'm': 'C',
    'n': 'D',
    'o': 'E',
    'p': 'F',
    'q': 'G',
    'r': 'H',
    's': 'I',
    't': 'J',
    'u': 'K',
    'v': 'L',
    'w': 'M',
    'x': 'N',
    'y': 'O',
    'z': 'P',
    '0': 'Q',
    '1': 'R',
    '2': 'S',
    '3': 'T',
    '4': 'U',
    '5': 'V',
    '6': 'W',
    '7': 'X',
    '8': 'Y',
    '9': 'Z',
    '-': '$',
    '_': '_'
}

def instagram_code_to_media_id(code):
   
    id = ""
    for letter in code:
        id += charmap[letter]
  
    alphabet = list(charmap.values())
    number = 0
    for char in id:
        number = number * 64 + alphabet.index(char)

    return number
  
media_id = instagram_code_to_media_id(code)

print(media_id)
# media_id == 2243569220713804232  # success