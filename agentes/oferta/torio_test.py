import requests
from bs4 import BeautifulSoup

# Set up the headers to mimic a browser request
headers = {
    "User-Agent": "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/85.0.4183.121 Safari/537.36"
}

# Function to get Instagram profile data
def get_instagram_profile(username):
    url = f'https://www.instagram.com/{username}/'
    response = requests.get(url, headers=headers)

    if response.status_code == 200:
        soup = BeautifulSoup(response.text, 'html.parser')
        print(soup)
        # profile_data = soup.find('meta', attrs={'property': 'og:description'})['content']
        # return profile_data
    else:
        return f"Error: Unable to access profile. Status code: {response.status_code}"

# Example usage
username = 'pablomarcalporsp'
profile_info = get_instagram_profile(username)
print(profile_info)
