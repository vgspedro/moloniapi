<?php

namespace VgsPedro\MoloniApi;

class Authentication
{

	private $company_id;

    public function getCompanyId()
    {
        return $this->company_id;
    }

    public function setCompanyId(int $company_id = 0)
    {
        $this->company_id = $company_id;
    }

 	private $access_token;

    public function getAccessToken()
    {
        return $this->access_token;
    }

    public function setAccessToken(string $access_token = null)
    {
        $this->access_token = $access_token;
    }

 	private $url;

    public function getUrl()
    {
        return $this->url;
    }

    public function setUrl(string $url = null)
    {
        $this->url = $url;
    }

	private $client_id;

    public function getClientId()
    {
        return $this->client_id;
    }

    public function setClientId(string $client_id = null)
    {
        $this->client_id = $client_id;
    }

 	private $password;

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword(string $password = null)
    {
        $this->password = $password;
    }

 	private $username;

    public function getUsername()
    {
        return $this->username;
    }

    public function setUsername(string $username = null)
    {
        $this->username = $username;
    }

	private $client_secret;

    public function getClientSecret()
    {
        return $this->client_secret;
    }

    public function setClientSecret(string $client_secret = null)
    {
        $this->client_secret = $client_secret;
    }

    /**
    *Get the current path for request
    *@param string action 
    *@return string 
    **/
    protected function getPath(string $action){
        return  $this->getUrl().''.static::ENTITY.''.$action.''.static::ACCESS.''.$this->getAccessToken();
    }

	/**
	* Get Tokens to allow data transaction of Company
	* @return json 
	* https://www.moloni.pt/dev/?action=getApiTxtDetail&id=3
	**/

	public function login()
	{
		$url = $this->getUrl().'/grant/?grant_type=password&client_id='.$this->getClientId().'&client_secret='.$this->getClientSecret().'&username='.$this->getUsername().'&password='.$this->getPassword();

		return $this->curl($url);
	}

	protected function curl(string $url, $post = null)
	{

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

		if (is_array($post)){
			$fields = (is_array($post)) ? http_build_query($post) : $post;
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
		}

		// Check if any error occurred
		if (curl_errno($ch)){
			$err = curl_error($ch);
			curl_close($ch);
		   	return $err;
		}

		$result = curl_exec($ch);
		curl_close($ch);
 		
 		$r = json_decode($result);
		//Check if user validation is wrong
		return isset($r->error) ? $r->error : $r;
    }



    /**
    *Future development ?
    *Get code errors and show info to user
    **/
    private function translateMessage(array $informations = []){
        
        if(is_string($informations[0])){

        $r = [];

        foreach ($informations as $info)
        {
            switch ($info) {
                case "1 name":
                    $r[]= "1 name = Campo nome não pode estar em branco";
                    break;
                case "1 number":
                    $r[] = "1 number = Campo number não pode estar em branco";
                    break;
                case "2 maturity_date_id 1 0":
                    $r[] = "2 maturity_date_id 1 0 = Defina um prazo de vencimento nas configurações do plugin";
                    break;
                case "2 unit_id 1 0":
                    $r[] = "2 maturity_unit_id 1 0 = Unidade de medida errada";
                    break;
                case "1 exemption_reason":
                    $r[] = "1 exemption_reason = Um dos artigos requer uma razão de isenção";
                    break;
                case "5 exemption_reason":
                    $r[] = "5 exemption_reason = Um dos artigos não tem uma razão de isenção definida";
                    break;
                case "5 document_set_id":
                    $r[] = "5 document_set_id = Não está definida a série onde quer emitir o documento";
                    break;
                case "2 price 0 null null 0":
                    $r[] = "2 price 0 null null 0 = Um dos artigos tem o preço igual a 0";
                    break;
                case "2 category_id 1 0":
                    $r[] = "2 category_id 1 0 = Um dos artigos não tem uma categoria definida.";
                    break;
            }
        }

        return $r;
    }
    
    return $informations;
    }
}