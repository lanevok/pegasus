import java.io.*;

public class CreateSQL {
    
    public static void main(String[] args) throws IOException {
	BufferedReader br = new BufferedReader(new InputStreamReader(new FileInputStream("res.txt")));
	
	String line;
	int i = 0;
	while((line=br.readLine())!=null){
	    System.out.println("'"+(++i)+"', '"+line+"',NOW( ) ,");
	    System.out.println("CURRENT_TIMESTAMP , NULL , NULL ,  '0',  '0'");
	    System.out.println("), (");
	}
    }
}
